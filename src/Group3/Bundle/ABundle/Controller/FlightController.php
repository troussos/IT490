<?php
/** @author troussos **/

namespace Group3\Bundle\ABundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use Group3\Bundle\ABundle\Form\FlightType;

class FlightController extends Controller
{

    /**
     * @Route("/flight/create", name="flightViewCreate")
     * @Route("/flight/{id}/edit", name="flightViewEdit")
     * @Method("GET")
     *
     * @param $id
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getCreateFlightAction($id = 0)
    {
        $flightHelper = $this->get('group3_a.flight_helper');
        $flight = $flightHelper->getFlightIfExists($id);

        $form = $this->createForm(new FlightType(), $flight);

        return $this->render(
            'Group3ABundle:pages/flight:createFlight.html.twig',
            array(
                'active' => $id,
                'form' => $form->createView(),
                'flight' => $flight
            )
        );
    }

    /**
     * @Route("/flight/create", name="flightPostCreate")
     * @Route("/flight/{id}/edit", name="flightPostEdit")
     * @Method("POST")
     *
     * @param $id
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function postCreateFlightAction($id = 0, Request $request)
    {
        $flightHelper = $this->get('group3_a.flight_helper');
        $flight = $flightHelper->getFlightIfExists($id);

        $form = $this->createForm(new FlightType(), $flight);

        $form->handleRequest($request);

        if ($form->isValid()) {

            $flightHelper->saveFlight($flight);

            $this->get('session')->getFlashBag()->add('success', 'Flight Successfully Saved');

            return $this->redirect(
                $this->generateUrl('flightGet', array('id'=>$flight->getId()))
            );
        }
        $this->get('session')->getFlashBag()->add('warning', 'Error Saving Flight');

        return $this->render(
            'Group3ABundle:pages/flight:createFlight.html.twig',
            array(
                'active' => $id,
                'form' => $form->createView(),
                'flight' => $flight
            )
        );
    }

    /**
     * @Route("/flight/{id}/delete", name="flightDelete")
     * @Method("GET")
     *
     * @param $id
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function deleteFlightAction($id)
    {
        $flightHelper = $this->get('group3_a.flight_helper');
        $flightHelper->removeFlight($id);

        $this->get('session')->getFlashBag()->add('failure', 'Flight Successfully Deleted');

        return $this->redirect(
            $this->generateUrl('flightGet')
        );
    }

    /**
     * @Route("/flight/{id}", name="flightGet")
     * @Method("GET")
     *
     * @param $id
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getFlightAction($id = 0)
    {
        $flightHelper = $this->get('group3_a.flight_helper');
        $flight = $flightHelper->getFlightById($id);

        return $this->render(
            'Group3ABundle:pages/flight:viewFlight.html.twig',
            array('active' => $id, 'flight' => @$flight)
        );
    }

    /**
     * Overridding the default render function to include the customer list with each page.
     *
     * @param string   $view
     * @param array    $params
     * @param Response $response
     *
     * @return Response
     */
    public function render($view, array $params = array(), Response $response = NULL)
    {
        $flightHelper = $this->get('group3_a.flight_helper');
        $params['flights'] =  $flightHelper->getAllFlights();
        $params['active'] = (@$params['active']) ?: 0;

        return parent::render($view, $params, $response);
    }
} 
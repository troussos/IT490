<?php
/** @author troussos **/

namespace Group3\Bundle\ABundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use Group3\Bundle\ABundle\Form\AirportType;

class AirportController extends Controller
{
    /**
     * @Route("/airport/create", name="airportViewCreate")
     * @Route("/airport/{id}/edit", name="airportViewEdit")
     * @Method("GET")
     *
     * @param $id
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getCreateAirportAction($id = 0)
    {
        $airportHelper = $this->get('group3_a.airport_helper');
        $airport = $airportHelper->getAirportIfExists($id);

        $form = $this->createForm(new AirportType(), $airport);

        return $this->render(
            'Group3ABundle:pages/airport:createAirport.html.twig',
            array(
                'active' => $id,
                'form' => $form->createView(),
                'airport' => $airport
            )
        );
    }

    /**
     * @Route("/airport/create", name="airportPostCreate")
     * @Route("/airport/{id}/edit", name="airportPostEdit")
     * @Method("POST")
     *
     * @param $id
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function postCreateAircraftAction($id = 0, Request $request)
    {
        $airportHelper = $this->get('group3_a.airport_helper');
        $airport = $airportHelper->getAirportIfExists($id);

        $form = $this->createForm(new AirportType(), $airport);

        $form->handleRequest($request);

        if ($form->isValid()) {

            $airportHelper->saveAirport($airport);

            $this->get('session')->getFlashBag()->add('success', 'Airport Successfully Saved');

            return $this->redirect(
                $this->generateUrl('airportGet', array('id'=>$airport->getId()))
            );
        }
        $this->get('session')->getFlashBag()->add('warning', 'Error Saving Airport');

        return $this->render(
            'Group3ABundle:pages/airport:createAirport.html.twig',
            array(
                'active' => $id,
                'form' => $form->createView(),
                'airport' => $airport
            )
        );
    }

    /**
     * @Route("/airport/{id}/delete", name="airportDelete")
     * @Method("GET")
     *
     * @param $id
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function deleteAirportAction($id)
    {
        $airportHelper = $this->get('group3_a.airport_helper');
        $airportHelper->removeAirport($id);

        $this->get('session')->getFlashBag()->add('failure', 'Airport Successfully Deleted');

        return $this->redirect(
            $this->generateUrl('airportGet')
        );
    }

    /**
     * @Route("/airport/{id}", name="airportGet")
     * @Method("GET")
     *
     * @param $id
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getAirportAction($id = 0)
    {
        $airportHelper = $this->get('group3_a.airport_helper');
        $airport = $airportHelper->getAirportById($id);

        return $this->render(
            'Group3ABundle:pages/airport:viewAirport.html.twig',
            array('active' => $id, 'airport' => @$airport)
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
        $airportHelper = $this->get('group3_a.airport_helper');
        $params['airports'] =  $airportHelper->getAllAirports();
        $params['active'] = (@$params['active']) ?: 0;

        return parent::render($view, $params, $response);
    }

} 
<?php
/** @author troussos **/

namespace Group3\Bundle\ABundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use Group3\Bundle\ABundle\Form\AircraftType;

class AircraftController extends Controller
{

    /**
     * @Route("/aircraft/create", name="aircraftViewCreate")
     * @Route("/aircraft/{id}/edit", name="aircraftViewEdit")
     * @Method("GET")
     *
     * @param $id
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getCreateAircraftAction($id = 0)
    {
        $aircraftHelper = $this->get('group3_a.aircraft_helper');
        $aircraft = $aircraftHelper->getAircraftIfExists($id);

        $form = $this->createForm(new AircraftType(), $aircraft);

        return $this->render(
            'Group3ABundle:pages/aircraft:createAircraft.html.twig',
            array(
                'active' => $id,
                'form' => $form->createView(),
                'aircraft' => $aircraft
            )
        );
    }

    /**
     * @Route("/aircraft/create", name="aircraftPostCreate")
     * @Route("/aircraft/{id}/edit", name="aircraftPostEdit")
     * @Method("POST")
     *
     * @param $id
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function postCreateAircraftAction($id = 0, Request $request)
    {
        $aircraftHelper = $this->get('group3_a.aircraft_helper');
        $aircraft = $aircraftHelper->getAircraftIfExists($id);

        $form = $this->createForm(new AircraftType(), $aircraft);

        $form->handleRequest($request);

        if ($form->isValid()) {

            $aircraftHelper->saveAircraft($aircraft);

            $this->get('session')->getFlashBag()->add('success', 'Aircraft Successfully Saved');

            return $this->redirect(
                $this->generateUrl('aircraftGet', array('id'=>$aircraft->getId()))
            );
        }
        $this->get('session')->getFlashBag()->add('warning', 'Error Saving Aircraft');

        return $this->render(
            'Group3ABundle:pages/aircraft:createAircraft.html.twig',
            array(
                'active' => $id,
                'form' => $form->createView(),
                'aircraft' => $aircraft
            )
        );
    }

    /**
     * @Route("/aircraft/{id}/delete", name="aircraftDelete")
     * @Method("GET")
     *
     * @param $id
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function deleteAircraftAction($id)
    {
        $aircraftHelper = $this->get('group3_a.aircraft_helper');
        $aircraftHelper->removeAircraft($id);

        $this->get('session')->getFlashBag()->add('failure', 'Aircraft Successfully Deleted');

        return $this->redirect(
            $this->generateUrl('aircraftGet')
        );
    }

    /**
     * @Route("/aircraft/{id}", name="aircraftGet")
     * @Method("GET")
     *
     * @param $id
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getAircraftAction($id = 0)
    {
        $aircraftHelper = $this->get('group3_a.aircraft_helper');
        $aircraft = $aircraftHelper->getAircraftById($id);

        return $this->render(
            'Group3ABundle:pages/aircraft:viewAircraft.html.twig',
            array('active' => $id, 'aircraft' => @$aircraft)
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
        $aircraftHelper = $this->get('group3_a.aircraft_helper');
        $params['aircrafts'] =  $aircraftHelper->getAllAircrafts();
        $params['active'] = (@$params['active']) ?: 0;

        return parent::render($view, $params, $response);
    }
} 
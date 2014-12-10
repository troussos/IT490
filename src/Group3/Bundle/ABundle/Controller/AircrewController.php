<?php
/** @author troussos **/

namespace Group3\Bundle\ABundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use Group3\Bundle\ABundle\Form\AircrewType;

class AircrewController extends Controller
{

    /**
     * @Route("/aircrew/create", name="aircrewViewCreate")
     * @Route("/aircrew/{id}/edit", name="aircrewViewEdit")
     * @Method("GET")
     *
     * @param $id
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getCreateAircrewAction($id = 0)
    {
        $aircrewHelper = $this->get('group3_a.aircrew_helper');
        $aircrew = $aircrewHelper->getAircrewIfExists($id);

        $form = $this->createForm(new AircrewType(), $aircrew);

        return $this->render(
            'Group3ABundle:pages/aircrew:createAircrew.html.twig',
            array(
                'active' => $id,
                'form' => $form->createView(),
                'aircrew' => $aircrew
            )
        );
    }

    /**
     * @Route("/aircrew/create", name="aircrewPostCreate")
     * @Route("/aircrew/{id}/edit", name="aircrewPostEdit")
     * @Method("POST")
     *
     * @param $id
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function postCreateAircrewAction($id = 0, Request $request)
    {
        $aircrewHelper = $this->get('group3_a.aircrew_helper');
        $aircrew = $aircrewHelper->getAircrewIfExists($id);

        $form = $this->createForm(new AircrewType(), $aircrew);

        $form->handleRequest($request);

        if ($form->isValid()) {

            $aircrewHelper->saveAircrew($aircrew);

            $this->get('session')->getFlashBag()->add('success', 'Aircrew Successfully Saved');

            return $this->redirect(
                $this->generateUrl('aircrewGet', array('id'=>$aircrew->getId()))
            );
        }
        $this->get('session')->getFlashBag()->add('warning', 'Error Saving Aircrew');

        return $this->render(
            'Group3ABundle:pages/aircrew:createAircrew.html.twig',
            array(
                'active' => $id,
                'form' => $form->createView(),
                'aircrew' => $aircrew
            )
        );
    }

    /**
     * @Route("/aircrew/{id}/delete", name="aircrewDelete")
     * @Method("GET")
     *
     * @param $id
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function deleteAircrewAction($id)
    {
        $aircrewHelper = $this->get('group3_a.aircrew_helper');
        $aircrewHelper->removeAircrew($id);

        $this->get('session')->getFlashBag()->add('failure', 'Aircrew Successfully Deleted');

        return $this->redirect(
            $this->generateUrl('aircrewGet')
        );
    }

    /**
     * @Route("/aircrew/{id}", name="aircrewGet")
     * @Method("GET")
     *
     * @param $id
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getAircrewAction($id = 0)
    {
        $aircrewHelper = $this->get('group3_a.aircrew_helper');
        $aircrew = $aircrewHelper->getAircrewById($id);

        return $this->render(
            'Group3ABundle:pages/aircrew:viewAircrew.html.twig',
            array('active' => $id, 'aircrew' => @$aircrew)
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
        $aircraftHelper = $this->get('group3_a.aircrew_helper');
        $params['aircrews'] =  $aircraftHelper->getAllAircrews();
        $params['active'] = (@$params['active']) ?: 0;

        return parent::render($view, $params, $response);
    }
}
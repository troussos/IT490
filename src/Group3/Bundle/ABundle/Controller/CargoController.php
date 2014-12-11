<?php
/** @author troussos **/

namespace Group3\Bundle\ABundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use Group3\Bundle\ABundle\Form\CargoType;

class CargoController extends Controller
{

    /**
     * @Route("/cargo/create", name="cargoViewCreate")
     * @Route("/cargo/{id}/edit", name="cargoViewEdit")
     * @Method("GET")
     *
     * @param $id
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getCreateCargoAction($id = 0)
    {
        $cargoHelper = $this->get('group3_a.cargo_helper');
        $cargo = $cargoHelper->getCargoIfExists($id);

        $form = $this->createForm(new CargoType(), $cargo);

        return $this->render(
            'Group3ABundle:pages/cargo:createCargo.html.twig',
            array(
                'active' => $id,
                'form' => $form->createView(),
                'cargo' => $cargo
            )
        );
    }

    /**
     * @Route("/cargo/create", name="cargoPostCreate")
     * @Route("/cargo/{id}/edit", name="cargoPostEdit")
     * @Method("POST")
     *
     * @param $id
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function postCreateCargoAction($id = 0, Request $request)
    {
        $cargoHelper = $this->get('group3_a.cargo_helper');
        $cargo = $cargoHelper->getCargoIfExists($id);

        $form = $this->createForm(new CargoType(), $cargo);

        $form->handleRequest($request);

        if ($form->isValid()) {

            $cargoHelper->saveCargo($cargo);

            $this->get('session')->getFlashBag()->add('success', 'Cargo Successfully Saved');

            return $this->redirect(
                $this->generateUrl('cargoGet', array('id'=>$cargo->getId()))
            );
        }
        $this->get('session')->getFlashBag()->add('warning', 'Error Saving Cargo');

        return $this->render(
            'Group3ABundle:pages/cargo:createCargo.html.twig',
            array(
                'active' => $id,
                'form' => $form->createView(),
                'cargo' => $cargo
            )
        );
    }

    /**
     * @Route("/cargo/{id}/delete", name="cargoDelete")
     * @Method("GET")
     *
     * @param $id
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function deleteCargoAction($id)
    {
        $cargoHelper = $this->get('group3_a.cargo_helper');
        $cargoHelper->removeCargo($id);

        $this->get('session')->getFlashBag()->add('failure', 'Cargo Successfully Deleted');

        return $this->redirect(
            $this->generateUrl('cargoGet')
        );
    }

    /**
     * @Route("/cargo/{id}", name="cargoGet")
     * @Method("GET")
     *
     * @param $id
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getCargoAction($id = 0)
    {
        $cargoHelper = $this->get('group3_a.cargo_helper');
        $cargo = $cargoHelper->getCargoById($id);

            return $this->render(
            'Group3ABundle:pages/cargo:viewCargo.html.twig',
            array('active' => $id, 'cargo' => @$cargo)
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
        $cargoHelper = $this->get('group3_a.cargo_helper');
        $params['cargos'] =  $cargoHelper->getAllCargos();
        $params['active'] = (@$params['active']) ?: 0;

        return parent::render($view, $params, $response);
    }
} 
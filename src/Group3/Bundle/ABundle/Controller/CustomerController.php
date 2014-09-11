<?php
/** @author troussos **/

namespace Group3\Bundle\ABundle\Controller;

use Group3\Bundle\ABundle\Entity\Customer;
use Group3\Bundle\ABundle\Form\CustomerType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use Group3\Bundle\ABundle\Service\CustomerHelper;

class CustomerController extends Controller
{
    /**
     * @Route("/customer/create", name="customerViewCreate")
     * @Route("/customer/{id}/edit", name="customerViewEdit")
     * @Method("GET")
     *
     * @param $id
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getCreateCustomerAction($id = 0)
    {
        /**
         * @var CustomerHelper
         */
        $customerHelper = $this->get('group3_a.customer_helper');
        $customer = $customerHelper->getCustomerIfExists($id);

        $form = $this->createForm(new CustomerType(), $customer);

        return $this->render(
            'Group3ABundle:pages/customer:createCustomer.html.twig',
            array('active' => $id, 'form' => $form->createView())
        );
    }

    /**
     * @Route("/customer/create", name="customerPostCreate")
     * @Route("/customer/{id}/edit", name="customerPostEdit")
     * @Method("POST")
     *
     * @param $id
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function postCreateCustomerAction($id = 0, Request $request)
    {
        /**
         * @var CustomerHelper
         */
        $customerHelper = $this->get('group3_a.customer_helper');
        $customer = $customerHelper->getCustomerIfExists($id);

        $form = $this->createForm(new CustomerType(), $customer);

        $form->handleRequest($request);

        if ($form->isValid()) {

            $customerHelper->saveCustomer($customer);

            return $this->redirect(
                $this->generateUrl('customerGet', array('id'=>$customer->getId()))
            );
        }
        // TODO Redirect back with errors
    }

    /**
     * @Route("/customer/{id}/delete", name="customerDelete")
     * @Method("GET")
     *
     * @param $id
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function deleteCustomerAction($id)
    {
        $customerHelper = $this->get('group3_a.customer_helper');
        $customerHelper->removeCustomer($id);

        return $this->redirect(
            $this->generateUrl('customerGet')
        );
    }


    /**
     * @Route("/customer/{id}", name="customerGet")
     * @Method("GET")
     *
     * @param $id
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getCustomerAction($id = 0)
    {
        $customerHelper = $this->get('group3_a.customer_helper');
        $customer = $customerHelper->getCustomerById($id);

        return $this->render(
            'Group3ABundle:pages/customer:viewCustomer.html.twig',
            array('active' => $id, 'customer' => @$customer)
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
        $customerHelper = $this->get('group3_a.customer_helper');
        $params['customers'] =  $customerHelper->getAllCustomers();
        $params['active'] = (@$params['active']) ?: 0;

        return parent::render($view, $params, $response);
    }
}
<?php
/** @author troussos **/

namespace Group3\Bundle\ABundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class CargoController extends Controller
{

    /**
     * @Route("/cargo/{id}", name="cargoGet")
     * @Method("GET")
     *
     * @param $id
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getCargotAction($id = 0)
    {
        $customerHelper = $this->get('group3_a.customer_helper');
        $customer = $customerHelper->getCustomerById($id);

        return $this->render(
            'Group3ABundle:pages/customer:viewCustomer.html.twig',
            array('active' => $id, 'customer' => @$customer)
        );
    }

} 
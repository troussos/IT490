<?php
/** @author troussos **/

namespace Group3\Bundle\ABundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class OrderController extends Controller
{

    /**
     * @Route("/order/{id}", name="orderGet")
     * @Method("GET")
     *
     * @param $id
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getOrderAction($id = 0)
    {
        //TODO - Look up entities from the DB here and return a nicely formatted array
        return $this->render('Group3ABundle:pages:order.html.twig');
    }

}
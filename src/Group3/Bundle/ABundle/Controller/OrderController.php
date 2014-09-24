<?php
/** @author troussos **/

namespace Group3\Bundle\ABundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use Group3\Bundle\ABundle\Form\CustomerOrderType;

class OrderController extends Controller
{

    /**
     * View the Create Order page and prepopulate it, if we are updating an order.
     *
     * @Route("/order/create", name="orderViewCreate")
     * @Route("/order/{id}/edit", name="orderViewEdit")
     * @Method("GET")
     *
     * @param $id
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getCreateOrderAction($id = 0)
    {
        /**
         * @var OrderHelper
         */
        $orderHelper = $this->get('group3_a.order_helper');
        $order = $orderHelper->getOrderIfExists($id);

        $form = $this->createForm(new CustomerOrderType(), $order);

        return $this->render(
            'Group3ABundle:pages/order:createOrder.html.twig',
            array(
                'active' => $id,
                'form' => $form->createView(),
                'order' => $order
            )
        );
    }

    /**
     * @Route("/order/create", name="orderPostCreate")
     * @Route("/order/{id}/edit", name="orderPostEdit")
     * @Method("POST")
     *
     * @param $id
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function postCreateOrderAction($id = 0, Request $request)
    {
        /**
         * @var OrderHelper
         */
        $orderHelper = $this->get('group3_a.order_helper');
        $order = $orderHelper->getOrderIfExists($id);

        $form = $this->createForm(new CustomerOrderType(), $order);

        $form->handleRequest($request);

        if ($form->isValid()) {

            $order->setTotalAmount(10);
            $orderHelper->saveOrder($order);

            $this->get('session')->getFlashBag()->add('success', 'Order Successfully Saved');

            return $this->redirect(
                $this->generateUrl('orderGet', array('id'=>$order->getId()))
            );
        }
        $this->get('session')->getFlashBag()->add('warning', 'Error Saving Order');

        return $this->render(
            'Group3ABundle:pages/order:createOrder.html.twig',
            array(
                'active' => $id,
                'form' => $form->createView(),
                'order' => $order
            )
        );
    }

    /**
     * @Route("/order/{id}/delete", name="orderDelete")
     * @Method("GET")
     *
     * @param $id
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function deleteOrderAction($id)
    {
        $orderHelper = $this->get('group3_a.order_helper');
        $orderHelper->removeOrder($id);

        $this->get('session')->getFlashBag()->add('failure', 'Order Successfully Deleted');

        return $this->redirect(
            $this->generateUrl('orderGet')
        );
    }

    /**
     * View the order, loading the selecte one (if there is a selected)
     *
     * @Route("/order/{id}", name="orderGet")
     * @Method("GET")
     *
     * @param $id
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getOrderAction($id = 0)
    {
        /**
         * @var OrderHelper
         */
        $orderHelper = $this->get('group3_a.order_helper');
        $order = $orderHelper->getOrderById($id);

        return $this->render(
            'Group3ABundle:pages/order:viewOrder.html.twig',
            array('order' => @$order)
        );
    }

    /**
     * Overridding the default render function to include the order list with each page.
     *
     * @param string   $view
     * @param array    $params
     * @param Response $response
     *
     * @return Response
     */
    public function render($view, array $params = array(), Response $response = NULL)
    {
        /**
         * @var OrderHelper
         */
        $orderHelper = $this->get('group3_a.order_helper');
        $params['orders'] =  $orderHelper->getAllOrders();
        $params['active'] = (@$params['active']) ?: 0;

        return parent::render($view, $params, $response);
    }

}
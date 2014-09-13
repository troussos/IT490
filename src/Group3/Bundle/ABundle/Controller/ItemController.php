<?php
/** @author troussos **/

namespace Group3\Bundle\ABundle\Controller;

use Group3\Bundle\ABundle\Form\InventoryType;
use Proxies\__CG__\Group3\Bundle\ABundle\Entity\Inventory;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Group3\Bundle\ABundle\Service\ItemHelper;

class ItemController extends Controller
{

    /**
     * View the Create Item page and prepopulate it, if we are updating an item.
     *
     * @Route("/item/create", name="itemViewCreate")
     * @Route("/item/{id}/edit", name="itemViewEdit")
     * @Method("GET")
     *
     * @param $id
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getCreateItemAction($id = 0)
    {
        /**
         * @var ItemHelper
         */
        $itemHelper = $this->get('group3_a.item_helper');
        $item = $itemHelper->getItemIfExists($id);

        $form = $this->createForm(new InventoryType(), $item);

        return $this->render(
            'Group3ABundle:pages/item:createItem.html.twig',
            array(
                'active' => $id,
                'form' => $form->createView(),
                'item' => $item
            )
        );
    }

    /**
     * @Route("/item/create", name="itemPostCreate")
     * @Route("/item/{id}/edit", name="itemPostEdit")
     * @Method("POST")
     *
     * @param $id
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function postCreateItemAction($id = 0, Request $request)
    {
        /**
         * @var ItemHelper
         */
        $itemHelper = $this->get('group3_a.item_helper');
        $item = $itemHelper->getItemIfExists($id);

        $form = $this->createForm(new InventoryType(), $item);

        $form->handleRequest($request);

        if ($form->isValid()) {

            $itemHelper->saveItem($item);

            $this->get('session')->getFlashBag()->add('success', 'Item Successfully Saved');

            return $this->redirect(
                $this->generateUrl('itemGet', array('id'=>$item->getId()))
            );
        }
        $this->get('session')->getFlashBag()->add('warning', 'Error Saving Item');

        return $this->render(
            'Group3ABundle:pages/item:createItem.html.twig',
            array(
                'active' => $id,
                'form' => $form->createView(),
                'item' => $item
            )
        );
    }

    /**
     * @Route("/item/{id}/delete", name="itemDelete")
     * @Method("GET")
     *
     * @param $id
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function deleteItemAction($id)
    {
        $itemHelper = $this->get('group3_a.item_helper');
        $itemHelper->removeItem($id);

        $this->get('session')->getFlashBag()->add('failure', 'Item Successfully Deleted');

        return $this->redirect(
            $this->generateUrl('itemGet')
        );
    }

    /**
     * View the items, loading the selecte one (if there is a selected)
     *
     * @Route("/item/{id}", name="itemGet")
     * @Method("GET")
     *
     * @param $id
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getItemAction($id = 0)
    {
        /**
         * @var ItemHelper
         */
        $itemHelper = $this->get('group3_a.item_helper');
        $item = $itemHelper->getItemById($id);

        return $this->render(
            'Group3ABundle:pages/item:viewItem.html.twig',
            array('item' => $item)
        );
    }

    /**
     * Overridding the default render function to include the item list with each page.
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
         * @var ItemHelper
         */
        $itemHelper = $this->get('group3_a.item_helper');
        $params['items'] =  $itemHelper->getAllItems();
        $params['active'] = (@$params['active']) ?: 0;

        return parent::render($view, $params, $response);
    }

}
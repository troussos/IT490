<?php
/** @author troussos **/

namespace Group3\Bundle\ABundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class ItemController extends Controller
{

    /**
     * @Route("/item/{id}", name="itemGet")
     * @Method("GET")
     *
     * @param $id
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getItemAction($id = 0)
    {
        //TODO - Look up entities from the DB here and return a nicely formatted array
        return $this->render('Group3ABundle:pages:item.html.twig');
    }

}
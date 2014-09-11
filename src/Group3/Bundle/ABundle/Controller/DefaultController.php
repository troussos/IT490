<?php

namespace Group3\Bundle\ABundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('Group3ABundle:Default:index.html.twig', array('name' => $name));
    }
}

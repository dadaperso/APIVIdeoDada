<?php

namespace LocDVD\APIBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('LocDVDAPIBundle:Default:index.html.twig', array('name' => $name));
    }
}

<?php

namespace ProAddress\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('ProAddressUserBundle:Default:index.html.twig');
    }
}

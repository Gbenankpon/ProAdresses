<?php

namespace ProAddress\AnnonceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('ProAddressAnnonceBundle:Default:index.html.twig');
    }
}

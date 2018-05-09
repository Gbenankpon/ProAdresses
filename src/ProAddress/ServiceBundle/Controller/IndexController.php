<?php

namespace ProAddress\ServiceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use ProAddress\ServiceBundle\Entity\SCategorie;

class IndexController extends Controller
{
    public function indexAction()
    {
        return $this->render('ProAddressServiceBundle:Default:index.html.twig');
    }

    public function getSCategorieAction(){
        $servicescat = $this->getDoctrine()->getManager()->getRepository('ProAddressServiceBundle:SCategorie')->findBy(array(),array('nom'=>'asc'),null,null);

        return $this->render('ProAddressServiceBundle::scategorie.html.twig', array('servicescat'=>$servicescat));
    }
}

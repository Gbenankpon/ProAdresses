<?php

namespace ProAddress\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Response;

use ProAddress\AppBundle\Entity\Structure;
use ProAddress\AppBundle\Form\StructureType;
use ProAddress\AppBundle\Entity\Pays;
use ProAddress\AppBundle\Entity\Categorie;
use ProAddress\ServiceBundle\Entity\SCategorie;
use ProAddress\AnnonceBundle\Entity\ACategorie;
use ProAddress\AnnonceBundle\Entity\Annonce;
use ProAddress\AppBundle\Entity\Message;
use ProAddress\AppBundle\Form\MessageType;
use ProAddress\AppBundle\Entity\Stat;


class AdminController extends Controller
{
    protected $path;
    protected $request;

    protected function addFlash($type, $message)
    {
    }

    public function __construct()
    {
        $this->request = request::createFromGlobals();
        $this->path = $this->request->getPathInfo();
    }

    public function getStatAction(){

        $stat = $this->get('pa.stat');

        $visitejour = $stat->getVisiteJour();
        $visitetotale = $stat->getVisiteTotale();
        $visitemoy = $stat->getVisiteMoy();

        return $this->render('ProAddressAppBundle:Admin:stat.html.twig',
            array(
                'visitetotale' => $visitetotale,
                'visitejour' => $visitejour,
                //'visiterecord' => $visiterecord,
                'visitemoy' => $visitemoy
            )
        );
    }

}

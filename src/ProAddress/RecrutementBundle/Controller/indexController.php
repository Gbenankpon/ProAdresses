<?php

namespace ProAddress\RecrutementBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use ProAddress\RecrutementBundle\Entity\Recrutement;
class IndexController extends Controller
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @ParamConverter("$recrutement", options={"mapping": {"pays": "pays"}})
     */
    public function indexAction(Recrutement $recrutement)
    {
        $em = $this->getDoctrine()->getManager();
        if($pays == 'all'){
            $recrutement = $em->getRepository('ProAddressRecrutementBundle:Recrutement')->findAll();
        }
        return $this->render('ProAddressRecrutementBundle:Recrutement:index.html.twig');
    }
}

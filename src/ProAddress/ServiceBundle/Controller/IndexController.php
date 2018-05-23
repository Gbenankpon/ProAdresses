<?php

namespace ProAddress\ServiceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

use ProAddress\AppBundle\Entity\Pays;
use ProAddress\ServiceBundle\Entity\SCategorie;
use ProAddress\ServiceBundle\Entity\Service;
use ProAddress\ServiceBundle\Form\ServiceType;

class IndexController extends Controller
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

    public function indexAction()
    {
        return $this->render('ProAddressServiceBundle:Default:index.html.twig');
    }

    public function getSCategorieAction(){
        $servicescat = $this->getDoctrine()->getManager()->getRepository('ProAddressServiceBundle:SCategorie')->findBy(array(),array('nom'=>'asc'),null,null);

        return $this->render('ProAddressServiceBundle::scategorie.html.twig', array('servicescat'=>$servicescat));
    }

    public function registerAction(Request $request){

        $service = new Service();
        $serviceform = $this->createForm('ProAddress\ServiceBundle\Form\ServiceType', $service);

        if($this->request->isMethod('POST')) {
            $serviceform->handleRequest($request);

            if ($serviceform->isSubmitted() && $serviceform->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($service);
                $em->flush();
            }

            return $this->redirectToRoute('pa_service');
        }

        return $this->render('ProAddressServiceBundle:Content:register.html.twig', array(
            'serviceform' => $serviceform->createView(),
            //'servicescat' => $servicescat
        ));
    }

    /**
     * @param $cat
     * @param $cp
     */
    public function contentAction($cat,$cp,$page,$id, Request $request){
        $em = $this->getDoctrine()->getManager();

        // register service form
        $service = new Service();
        $serviceform = $this->createForm('ProAddress\ServiceBundle\Form\ServiceType', $service);

        if($this->request->isMethod('POST')) {
            $serviceform->handleRequest($request);

            if ($serviceform->isSubmitted() && $serviceform->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $post = $serviceform->getData();
                $repo = $em->getRepository('ProAddressServiceBundle:Service')->findAll();
                foreach ($repo as $item) {
                    if(strtoupper($item->getEntreprise()) === strtoupper($post->getEntreprise())
                        && strtoupper($item->getSpecialite()) === strtoupper($post->getSpecialite())
                        && strtoupper($item->getPays()->getNom()) === strtoupper($post->getPays()->getNom())){
                        $this->get('session')->getFlashBag()->add('warning', 'Ce service existe déjà !');
                        return $this->redirect($this->generateUrl('pa_service'));
                    }
                }
                $em->persist($service);
                $em->flush();
                $this->get('session')->getFlashBag()->add('success', 'Données envoyés avec succès !');
            }

            return $this->redirectToRoute('pa_app_accueil');
        }// end form

        if($cp === 'oo'){
            $pays = $em->getRepository('ProAddressAppBundle:Pays')->findAll();
            $services = $em->getRepository('ProAddressServiceBundle:Service')->findByCatCp($cat,$cp,$page);

            return $this->render('ProAddressServiceBundle:Content:index.html.twig', array(
                    'pays'=>$pays,
                    'cat'=>$cat,
                    'services'=>$services,
                    'page'=> $page,
                    'nbrPage'=> ceil(count($services)/10),
                    'serviceform'=>$serviceform->createView())
            );
        }
        if($id === 0){
            $unservice = '';
        }
        else{
            $unservice = $em->getRepository('ProAddressServiceBundle:Service')->findOneById($id);
        }

        $services = $em->getRepository('ProAddressServiceBundle:Service')->findByCatCp($cat,$cp,$page);
        $pays = $em->getRepository('ProAddressAppBundle:Pays')->findOneBy(array('code'=>$cp));

        return $this->render('ProAddressServiceBundle:Content:content.html.twig', array(
            'services' => $services,
            'cat'=>$cat,
            'pays'=>$pays,
            'page'=> $page,
            'nbrPage' => ceil(count($services)/10),
            'serviceform'=>$serviceform->createView(),
            'unservice'=>$unservice
        ));
    }
}

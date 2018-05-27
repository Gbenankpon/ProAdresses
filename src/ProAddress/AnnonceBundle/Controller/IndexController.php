<?php

namespace ProAddress\AnnonceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\Request;
//use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

//use ProAddress\AppBundle\Entity\Pays;
//use ProAddress\AnnonceBundle\Entity\ACategorie;
use ProAddress\AnnonceBundle\Entity\Annonce;
//use ProAddress\AnnonceBundle\Form\AnnonceType;

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
        return $this->render('ProAddressAnnonceBundle:Default:index.html.twig');
    }

    public function getACategorieAction(){
        $annoncescat = $this->getDoctrine()->getManager()->getRepository('ProAddressAnnonceBundle:ACategorie')->findBy(array(),array('nom'=>'asc'),null,null);

        return $this->render('ProAddressAnnonceBundle::acategorie.html.twig', array('annoncescat'=>$annoncescat));
    }

    public function registerAction(Request $request){

        $annonce = new Annonce();
        $annonceform = $this->createForm('ProAddress\AnnonceBundle\Form\AnnonceType', $annonce);

        if($this->request->isMethod('POST')) {
            $annonceform->handleRequest($request);

            if ($annonceform->isSubmitted() && $annonceform->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($annonce);
                $em->flush();
            }

            return $this->redirectToRoute('pa_annonce');
        }

        return $this->render('ProAddressAnnonceBundle:Content:register.html.twig', array(
            'annonceform' => $annonceform->createView(),
            //'servicescat' => $servicescat
        ));
    }

    /**
     * @param $cat
     * @param $cp
     */
    public function contentAction($cat,$cp,$page,$id, Request $request){
        $em = $this->getDoctrine()->getManager();

        // register annonce form
        $annonce = new Annonce();
        $annonceform = $this->createForm('ProAddress\AnnonceBundle\Form\AnnonceType', $annonce);

        if($this->request->isMethod('POST')) {
            $annonceform->handleRequest($request);

            if ($annonceform->isSubmitted() && $annonceform->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $post = $annonceform->getData();
                $repo = $em->getRepository('ProAddressAnnonceBundle:Annonce')->findAll();
                foreach ($repo as $item) {
                    if(strtoupper($item->getTitre()) === strtoupper($post->getTitre())
                        && strtoupper($item->getPrix()) === strtoupper($post->getPrix())
                        && strtoupper($item->getPays()->getNom()) === strtoupper($post->getPays()->getNom())
                        && strtoupper($item->getACategorie()->getNom()) === strtoupper($post->getACategorie()->getNom())){
                        $this->get('session')->getFlashBag()->add('warning', 'Cette annonce existe déjà !');
                        return $this->redirect($this->generateUrl('pa_annonce'));
                    }
                }
                $em->persist($annonce);
                $em->flush();
                $this->get('session')->getFlashBag()->add('success', 'Données envoyés avec succès !');
            }

            return $this->redirectToRoute('pa_annonce');
        }// end form

        if($cp === 'oo'){
            $pays = $em->getRepository('ProAddressAppBundle:Pays')->findAll();
            $annonces = $em->getRepository('ProAddressAnnonceBundle:Annonce')->findByCatCp($cat,$cp,$page);

            return $this->render('ProAddressAnnonceBundle:Content:index.html.twig', array(
                    'pays'=>$pays,
                    'cat'=>$cat,
                    'annonces'=> $annonces,
                    'page'=> $page,
                    'nbrPage'=> ceil(count($annonces)/10),
                    'annonceform'=>$annonceform->createView())
            );
        }

        if($id === 0){
            $annonce = '';
        }
        else{
            $annonce = $em->getRepository('ProAddressAnnonceBundle:Annonce')->findOneById($id);
        }
        $annonces = $em->getRepository('ProAddressAnnonceBundle:Annonce')->findByCatCp($cat,$cp,$page);
        $pays = $em->getRepository('ProAddressAppBundle:Pays')->findOneBy(array('code'=>$cp));

        return $this->render('ProAddressAnnonceBundle:Content:content.html.twig', array(
            'annonces' => $annonces,
            'cat'=>$cat,
            'pays'=>$pays,
            'page'=> $page,
            'nbrPage' => ceil(count($annonces)/10),
            'annonceform'=>$annonceform->createView(),
            'annonce'=>$annonce
        ));
    }
}

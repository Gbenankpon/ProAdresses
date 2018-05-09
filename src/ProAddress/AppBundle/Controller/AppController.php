<?php

namespace ProAddress\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\Request;

use ProAddress\AppBundle\Entity\Structure;
use ProAddress\AppBundle\Form\StructureType;
use ProAddress\AppBundle\Entity\Pays;
use ProAddress\AppBundle\Entity\Categorie;
use ProAddress\ServiceBundle\Entity\SCategorie;


class AppController extends Controller
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

    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        // Register the pays if table's empty
        if(empty($em->getRepository('ProAddressAppBundle:Pays')->findAll())) {
            $paysAr = [
                'nom' => ['BENIN', 'BURKINA FASO', 'COTE D\'IVOIRE', 'GUINEE BISSAU', 'MALI', 'NIGER', 'SENEGAL', 'TOGO'],
                'code' => ['bj', 'bf', 'ci', 'gw', 'ml', 'ne', 'sn', 'tg']
            ];

            for ($i = 0; $i < 8; $i++) {
                $pays[$i] = new Pays();
                $pays[$i]->setNom($paysAr['nom'][$i])
                    ->setCode($paysAr['code'][$i]);

                $em->persist($pays[$i]);
            }

            $em->flush();
        }
        // .register

        // Register categories of structure if table's empty
        if(empty($em->getRepository('ProAddressAppBundle:Categorie')->findAll())) {
            $catAr = ['bibliotheque','centre-de-sante','partisserie','pharmacie','supermarche'];

            foreach($catAr as $i=>$cat){
                $categorie[$i] = new Categorie();
                $categorie[$i]->setNom($cat);

                $em->persist($categorie[$i]);
            }

            $em->flush();
        }
        // .Register categorie

        // Register scategorie for service if table's empty
        if(empty($em->getRepository('ProAddressServiceBundle:SCategorie')->findAll())){
            $scatAr = ['technique','technologie','informatique','it','securite','voyage','location','decoration','menage','internet','immobilier'];

            foreach ($scatAr as $i=>$scat) {
                $scategorie[$i] = new SCategorie();
                $scategorie[$i]->setNom($scat);

                $em->persist($scategorie[$i]);
            }

            $em->flush();
        }
        // Bord nav i.e links of structures categories
        //$structurescat = $em->getRepository('ProAddressAppBundle:Categorie')->findAll();
        $servicescat = $em->getRepository('ProAddressServiceBundle:SCategorie')->findBy(array(),array('nom'=>'asc'),null,null);
        // .Bord

        // content
        switch($this->path){
            case '/':
                $structure = new Structure();
                $structureform = $this->createForm('ProAddress\AppBundle\Form\StructureType', $structure);

                if($this->request->isMethod('POST')) {
                    $structureform->handleRequest($request);

                    if ($structureform->isSubmitted() && $structureform->isValid()) {
                        $em = $this->getDoctrine()->getManager();
                        $em->persist($structure);
                        $em->flush();
                    }

                    return $this->redirectToRoute('pa_app_accueil');
                }

                return $this->render('ProAddressAppBundle:App:accueil.html.twig', array(
                    'structureform' => $structureform->createView(),
                   // 'structurescat' => $structurescat,
                    'servicescat' => $servicescat
                ));
            case '/structures/':
                $view = '';
        }

        return $this->redirectToRoute('pa_app_accueil');
    }

    public function accueil(){
        $em = $this->getDoctrine()->getManager();

        $structurescat = $em->getRepository('ProAddressAppBundle:Categorie')->findAll();

        $structure = new Structure();
        $structureform = $this->createForm('ProAddress\AppBundle\Form\StructureType', $structure);

        if($this->request->isMethod('POST')) {
            $structureform->handleRequest($request);

            if ($structureform->isSubmitted() && $structureform->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($structure);
                $em->flush();
            }

            return $this->redirectToRoute('pa_app_accueil');
        }

        return $this->render('ProAddressAppBundle:App:accueil.html.twig', array(
            'structureform' => $structureform->createView(),
            'structurescat' => $structurescat
        ));
    }

    public function getCategorieAction(){
        $structurescat = $this->getDoctrine()->getManager()->getRepository('ProAddressAppBundle:Categorie')->findAll();

        return $this->render('ProAddressAppBundle:App:categorie.html.twig', array('structurescat'=>$structurescat));
    }
}

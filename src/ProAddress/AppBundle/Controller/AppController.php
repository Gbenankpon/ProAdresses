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

    public function accueilAction(Request $request)
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

        // Register acategorie for annonce if table's empty
        if(empty($em->getRepository('ProAddressAnnonceBundle:ACategorie')->findAll())){
            $scatAr = ['recrutement', 'vente', 'achat'];

            foreach ($scatAr as $i=>$acat) {
                $acategorie[$i] = new ACategorie();
                $acategorie[$i]->setNom($acat);

                $em->persist($acategorie[$i]);
            }

            $em->flush();
        }// end register

        // Bord nav i.e links of structures categories
        $servicescat = $em->getRepository('ProAddressServiceBundle:SCategorie')->findBy(array(),array('nom'=>'asc'),null,null);
        // .Bord

        // content
        $structure = new Structure();
        $structureform = $this->createForm('ProAddress\AppBundle\Form\StructureType', $structure);

        if($this->request->isMethod('POST')) {
            $structureform->handleRequest($request);

            if ($structureform->isSubmitted() && $structureform->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($structure);
                $em->flush();
                $this->get('session')->getFlashBag()->add('success', 'Données envoyés avec succès !');
            }

            return $this->redirectToRoute('pa_app_accueil');
        }

        return $this->render('ProAddressAppBundle:App:accueil.html.twig', array(
            'structureform' => $structureform->createView(),
            'servicescat' => $servicescat
        ));

    }

    /**
     * @param $cat
     * @param $cp
     * @return \Symfony\Component\HttpFoundation\Response
     *
     */
    public function contentAction($cat, $cp, $page){
        $em = $this->getDoctrine()->getManager();
        if($cat != 'all' and $cp === 'oo'){
            $pays = $em->getRepository('ProAddressAppBundle:Pays')->findAll();
            $structures = $em->getRepository('ProAddressAppBundle:Structure')->findByCatCp($cat,$cp,$page);

            return $this->render('ProAddressAppBundle:Content:index.html.twig', array(
                    'pays'=>$pays,
                    'cat'=>$cat,
                    'page'=> $page,
                    'structures'=>$structures,
                    'nbrPage'=> ceil(count($structures)/10)
                )
            );
        }

        $structures = $em->getRepository('ProAddressAppBundle:Structure')->findByCatCp($cat,$cp,$page);
        $pays = $em->getRepository('ProAddressAppBundle:Pays')->findOneBy(array('code'=>$cp));

        return $this->render('ProAddressAppBundle:Content:content.html.twig', array(
            'structures' => $structures,
            'cat'=>$cat,
            'pays'=>$pays,
            'page'=> $page,
            'nbrPage' => ceil(count($structures)/10)
            //'cate'=>$categorie
            //'structurescat' => $structurescat
        ));
    }

    public function getCategorieAction(){
        $structurescat = $this->getDoctrine()->getManager()->getRepository('ProAddressAppBundle:Categorie')->findAll();

        return $this->render('ProAddressAppBundle:App:categorie.html.twig', array('structurescat'=>$structurescat));
    }

    public function getPaysAction(){
        $pays = $this->getDoctrine()->getManager()->getRepository('ProAddressAppBundle:Pays')->findAll();

        return $this->render('ProAddressAppBundle:App:pays.html.twig', array('pays'=>$pays));
    }

    public function messageAction(Request $request){
        $message = new Message;
        //$message->setDate(new \Datetime);
        $messageform = $this->createForm('ProAddress\AppBundle\Form\MessageType', $message);

        if($this->request->isMethod('POST')) {
            $messageform->handleRequest($request);
            $em = $this->getDoctrine()->getManager();

            if ($messageform->isSubmitted() && $messageform->isValid()) {
                $em->persist($message);
                $em->flush();

                $this->get('session')->getFlashBag()->add('success', 'Message envoyé avec succès !');
            }

            return $this->redirect($this->generateUrl('pa_app_message'));
        }

        return $this->render('ProAddressAppBundle:App:message.html.twig',
            array(
                'messageform'=>$messageform->createView()
            )
        );
    }

    public function statAction(){

        // Comptage de visiteurs
        $lastVisitEntity = $this->getDoctrine()
            ->getManager()
            ->getRepository('ProAddressAppBundle:Stat')
            ->lastVisit();
        $visiteur = new Stat();

        $lastJour = $lastVisitEntity->getJour();
        $lastVisite = $lastVisitEntity->getVisite();

        $y = date('Y');
        $m = date('m');
        $d = date('d');
        $jour = ("$d-$m-$y");
        if($jour == $lastJour){
            $visiteur = $this->getDoctrine()
                ->getManager()
                ->getRepository('ProAddressAppBundle:Stat')
                ->find($lastVisitEntity->getId())
                ->setVisite($lastVisitEntity->getVisite()+1)
                ->setJour($jour);
            $em = $this->getDoctrine()->getManager();
            $em->persist($visiteur);
            $em->flush();
        }
        else{
            $visiteur->setJour($jour);
            $visiteur->setVisite('1');
            $em = $this->getDoctrine()->getManager();
            $em->persist($visiteur);
            $em->flush();
        }
        return new Response('');
    }

    public function getStatAction(){

        $stat = $this->get('pa.stat');

        $visitejour = $stat->getVisiteJour();
        $visitetotale = $stat->getVisiteTotale();
        $visitemoy = $stat->getVisiteMoy();

        return new $this->render('ProAddressAppBundle:Admin:stat.html.twig',
            array(
                'visitetotale' => $visitetotale,
                'visitejour' => $visitejour,
                //'visiterecord' => $visiterecord,
                'visitemoy' => $visitemoy
            )
        );
    }

    public function searchAction(){
        if(null == $this->request->request->get('recherche') || $this->request->request->get('recherche') == array()){
            return $this->redirect($this->generateUrl('pa_app_accueil'));
        }
        else{
            $searched = $this->request->request->get('recherche');
            $search = $this->getDoctrine()->getManager()->getRepository("ProAddressAppBundle:Structure")->formSearcher($searched);
            $length = count($search);
        }
        return $this->render('ProAddressAppBundle:App:search.html.twig',
            array(
                'page' => 'Search',
                'searchArray' => $search,
                'lengthAr' => $length
            )
        );
    }
}

<?php

namespace ProAddress\AppBundle\Recover;

class Recover
{
    protected $em;
    protected $qb;
    
    public function __construct($em){
        $this->em = $em;
        $qb = $em->createQueryBuilder('e');
    }
    public function paginateur($arr){
        if ($arr[4] < 1) {
            throw new \InvalidArgumentException('L\'argument $page ne peut
être inférieur à 1 (valeur : "'.$arr[4].'").');
        }

        $repo = $this->em->getRepository($arr[0].':'.$arr[1]);
        $qb = $this->em->createQueryBuilder();

        if($arr[3] == 'oo'){
            $rep = $qb->select('e')
                      ->from($arr[0].':'.$arr[1],'e')
                      ->join('e.categorie', 'c')
                //->where($qb->expr()->in('c.nom', $ar))
                ->where('c.nom= :cat')
                ->setParameter('cat',$arr[2])
                //->orderBy('s.date', 'desc')
                ->getQuery();
            // On définit l'article à partir duquel commencer la liste
            $qb ->setFirstResult(($arr[4]-1) * 10)
                // Ainsi que le nombre d'articles à afficher
                ->setMaxResults(10);
            // Enfin, on retourne l'objet Paginator correspondant à la requête construite
            // (n'oubliez pas le use correspondant en début de fichier)
            return new Paginator($qb);
        }
        elseif ($arr[2] === "all"){
            $qb = $this->createQueryBuilder('s');
            $qb ->join('s.pays','p')
                ->where('p.code= :cp')
                ->setParameter('cp',$arr[3])
                ->getQuery();
            $qb ->setFirstResult(($arr[4]-1) * 10)
                ->setMaxResults(10);
            return new Paginator($qb);
        }
        //$ar = array($arr[2]);
        $qb = $this->createQueryBuilder('s');
        $qb ->join('s.categorie', 'c')
            ->join('s.pays','p')
            //->where($qb->expr()->in('c.nom', $ar))
            ->where('c.nom= :cat')
            ->setParameter('cat',$arr[2])
            ->andWhere('p.code= :cp')
            ->setParameter('cp',$arr[3])
            //->orderBy('s.date', 'desc')
            ->getQuery();
        // On définit l'article à partir duquel commencer la liste
        $qb ->setFirstResult(($arr[4]-1) * 10)
            // Ainsi que le nombre d'articles à afficher
            ->setMaxResults(10);
        // Enfin, on retourne l'objet Paginator correspondant à la requête construite
        // (n'oubliez pas le use correspondant en début de fichier)
        return new Paginator($qb);

    }
    /*public function getNoms($arr){
        $repo = $this->em->getRepository($arr[0].':'.$arr[1]);
        $qb = $this->em->createQueryBuilder();
        
        if($arr[2] === null){
            $rep = $qb->select('e.nom')
                     ->from($arr[0].':'.$arr[1],'e')
                     ->orderBy('e.nom','ASC')
                     ;
        }
        if($arr[2] !== null){
            $rep = $qb->select('e.nom')
                     ->from($arr[0].':'.$arr[1],'e')
                     ->where("e.$arr[2]$arr[4]:p")
                        ->setParameter('p',$arr[3])
                     ->orderBy('e.nom','ASC')
                     ;
        }
        return $rep->getQuery()->getResult();
    }
    
    public function getNomsLength($arr){
        $repo = $this->em->getRepository($arr[0].':'.$arr[1]);
        $qb = $this->em->createQueryBuilder();
        
        if($arr[2] === null){
            $rep = $qb->select('e')
                     ->from($arr[0].':'.$arr[1],'e')
                     ;
        }
        if($arr[2] !== null){
            $rep = $qb->select('e.nom')
                     ->from($arr[0].':'.$arr[1],'e')
                     ->where("e.$arr[2]$arr[4]:p")
                        ->setParameter('p',$arr[3])
                     ;
        }
        
        return count($rep->getQuery()->getResult());
    }*/

}

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
    
    public function getNoms($arr){
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
    
    public function getLength($arr){
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
    }

}

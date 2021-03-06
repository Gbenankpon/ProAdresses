<?php

namespace ProAddress\AppBundle\Repository;

/**
 * StatRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class StatRepository extends \Doctrine\ORM\EntityRepository
{
    protected $entity;

    public function lastVisit(){
        $entities = $this->findAll();

        if($entities != null){
            foreach($entities as $entity){
                $this->entity = $entity;
            }
        }
        else{
            $y = date('Y');
            $m = date('m');
            $d = date('d');
            $jour = ("$d-$m-$y");
            $visiteur = new \ProAddress\AppBundle\Entity\Stat();
            $visiteur->setJour($jour);
            $visiteur->setVisite(0);
            $this->_em->persist($visiteur);
            $this->_em->flush();

            $this->entity = $visiteur;
        }

        return $this->entity;
    }

    /**
     * @return float
     */
    public function visiteMoy(){
        $moy = (float)$this->_em->createQuery('SELECT AVG(v.visite) FROM ProAddressBundle:Stat v')
            ->getResult();
        return $moy;
    }
}

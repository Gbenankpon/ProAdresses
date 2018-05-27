<?php

namespace ProAddress\AppBundle\Repository;

use Doctrine\ORM\Tools\Pagination\Paginator;

/**
 * StructureRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class StructureRepository extends \Doctrine\ORM\EntityRepository
{
    private $i = 0;
    private $entitiesAr = array();

    public function formSearcher($searched){

        foreach($this->findByOnline(true) as $entity){
            if(preg_match("#$searched#i", $entity->getEnseigne()) || preg_match("#$searched#i", $entity->getAdresse())){
                $this->entitiesAr[$this->i] = $entity;
                $enseigne[$this->i] = $entity->getEnseigne();
                $adr[$this->i] = $entity->getAdresse();

                if( preg_match("#$searched#i", $entity->getEnseigne())){
                    $enseigne[$this->i] = preg_replace("#\.*($searched)\.*#i", "<mark><b>$1</b></mark>", $entity->getEnseigne());
                }

                if(preg_match("#$searched#i", $entity->getAdresse())){
                    $adr[$this->i] = preg_replace("#\.*($searched)\.*#i", "<mark><b>$1</b></mark>", $entity->getAdresse());
                }
                $this->i++;
            }
        }

        for($j = 0;$j < $this->i; $j++){
            $this->entitiesAr[$j]->setEnseigne($enseigne[$j]);
            $this->entitiesAr[$j]->setAdresse($adr[$j]);
            $this->_em->detach($this->entitiesAr[$j]);
        }

        	return $this->entitiesAr;
    }

    public function findByCatCp($cat,$cp,$page){
        if ($page < 1) {
            throw new \InvalidArgumentException('L\'argument $page ne peut
être inférieur à 1 (valeur : "'.$page.'").');
        }
        if($cp == 'oo'){
            $qb = $this->createQueryBuilder('s');
            $qb ->join('s.categorie', 'c')
                //->where($qb->expr()->in('c.nom', $ar))
                ->where('c.nom= :cat')
                    ->setParameter('cat',$cat)
                ->andWhere('s.online = true')
                ->getQuery();
            // On définit l'article à partir duquel commencer la liste
            $qb ->setFirstResult(($page-1) * 10)
                // Ainsi que le nombre d'articles à afficher
                ->setMaxResults(10);
            // Enfin, on retourne l'objet Paginator correspondant à la requête construite
            // (n'oubliez pas le use correspondant en début de fichier)
            return new Paginator($qb);
        }
        elseif ($cat === "all"){
            $qb = $this->createQueryBuilder('s');
            $qb ->join('s.pays','p')
                ->where('p.code= :cp')
                    ->setParameter('cp',$cp)
                ->andWhere('s.online = true')
                ->getQuery();
            $qb ->setFirstResult(($page-1) * 10)
                ->setMaxResults(10);
            return new Paginator($qb);
        }
        //$ar = array($cat);
        $qb = $this->createQueryBuilder('s');
        $qb ->join('s.categorie', 'c')
            ->join('s.pays','p')
            //->where($qb->expr()->in('c.nom', $ar))
            ->where('c.nom= :cat')
                ->setParameter('cat',$cat)
            ->andWhere('p.code= :cp')
                ->setParameter('cp',$cp)
            ->andWhere('s.online = true')
            //->orderBy('s.date', 'desc')
            ->getQuery();
        // On définit l'article à partir duquel commencer la liste
        $qb ->setFirstResult(($page-1) * 10)
        // Ainsi que le nombre d'articles à afficher
            ->setMaxResults(10);
        // Enfin, on retourne l'objet Paginator correspondant à la requête construite
        // (n'oubliez pas le use correspondant en début de fichier)
        return new Paginator($qb);
    }
}

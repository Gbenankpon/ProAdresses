<?php
// Olympe/LczBundle/Stat/Stat.php

namespace ProAddress\AppBundle\Stat;

use Doctrine\ORM\EntityManager;

class Stat
{
	protected $findedAr = array();
	protected $em;	
	protected $findedNom = array();
	protected $findedTable = array();

	public function  __construct(EntityManager $em){
		$this->em = $em;
	}
	
	public function getVisiteJour(){
	    $visitejour = 0;
		$entities = $this->em->getRepository("ProAddressAppBundle:Stat")->findAll();
			foreach($entities as $entity){
				$visitejour = (integer)$entity->getVisite();
			}
		
		return	$visitejour;
	}
	
	public function getVisiteTotale(){
	    $visitetotale = 0;
		$entities = $this->em->getRepository("ProAddressAppBundle:Stat")->findAll();
			foreach($entities as $entity){
				$visitetotale += (integer)$entity->getVisite();
			}
	    
	    return $visitetotale;
	}
	
	/*public function getVisiteRecord(){
	    $visiterecord = 0;
		$entities = $this->em->getRepository("ProAddressAppBundle:Stat")->findAll();
			foreach($entities as $entity){
				$visiterecord += (integer)$entity->getVisite();
			}
	    
	    return $visiterecord;
	}*/
	
	public function getVisiteMoy(){
	    $visitemoy = 0.000;
	    $entities = $this->em->getRepository("ProAddressAppBundle:Stat")
		                      ->findAll();
		    $taille = count($entities);
			foreach($entities as $entity){
				$visitemoy += ($entity->getVisite())/$taille;
			}
	    return $visitemoy;
	}
/*	
		private function getNameable($tableNameArray){
		$i = 0;
		foreach($tableNameArray as $element){
			$this->tablesList[$i] = $element;
			$i += 1;
		}
*/
}

<?php
/**
 * Created by PhpStorm.
 * User: arthur
 * Date: 06/05/18
 * Time: 13:06
 */

namespace ProAddress\AppBundle\DataFixtures\ORM;

use ProAddress\AppBundle\Entity\Pays;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class PaysFixtures
{
    public function load(ObjectManager $m){
        $paysAr = [
                'nom'=>['BENIN','BURKINA FASO','COTE D\'IVOIRE','GUINEE BISSAU','MALI','NIGER','SENEGAL','TOGO'],
                'code'=>['bj','bf','ci','gw','ml','ne','sn','tg']
        ];

        for($i=0;$i<8;$i++){
            $pays[$i] = new Pays();
            $pays[$i]->setNom($paysAr['nom'][$i])
                     ->setCode($paysAr['code'][$i])
                ;

            $m->persist($pays[$i]);
        }

        $m->flush();
    }
}
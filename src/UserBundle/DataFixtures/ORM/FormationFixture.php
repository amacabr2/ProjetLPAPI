<?php
/**
 * Created by PhpStorm.
 * User: antho
 * Date: 26/02/2018
 * Time: 11:12
 */

namespace UserBundle\DataFixtures\ORM;


use Doctrine\Common\Persistence\ObjectManager;
use UserBundle\DataFixtures\FakerFixture;
use UserBundle\Entity\Formation;

class FormationFixture extends FakerFixture {

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager) {
        $formation1 = new Formation();
        $formation1->setName("DUT Info - TP1");

        $formation2 = new Formation();
        $formation2->setName("DUT Carrière Social - TP1");

        $manager->persist($formation1);
        $manager->persist($formation2);
        $manager->flush();
    }
}
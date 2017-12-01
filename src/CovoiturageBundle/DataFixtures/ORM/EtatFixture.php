<?php
/**
 * Created by PhpStorm.
 * User: amacabr2
 * Date: 29/11/17
 * Time: 18:33
 */

namespace CovoiturageBundle\DataFixtures\ORM;


use CovoiturageBundle\Entity\Etat;
use Doctrine\Common\Persistence\ObjectManager;
use UserBundle\DataFixtures\FakerFixture;

class EtatFixture extends FakerFixture {

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager) {
        $etats = ["bon", "moyen", "mauvais", "delabré"];

        for ($i = 0; $i < sizeof($etats); $i++) {
            $etat = new Etat();
            $etat->setLabel($etats[$i]);

            $manager->persist($etat);
        }

        $manager->flush();
    }
}
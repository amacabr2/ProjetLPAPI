<?php
/**
 * Created by PhpStorm.
 * User: amacabr2
 * Date: 28/11/17
 * Time: 12:23
 */

namespace CovoiturageBundle\DataFixtures\ORM;


use CovoiturageBundle\Entity\Localisation;
use CovoiturageBundle\Entity\Trajet;
use CovoiturageBundle\Entity\Vehicule;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use UserBundle\DataFixtures\FakerFixture;
use UserBundle\Entity\User;

class TrajetFixture extends FakerFixture {

    /**
     * @var Trajet[]
     */
    private static $trajets = [];

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager) {
        for ($i = 0; $i < 20; $i++) {
            $trajet = new Trajet();
            $trajet->setNbPlaceRestante(4);
        }

        $manager->flush();
    }


}
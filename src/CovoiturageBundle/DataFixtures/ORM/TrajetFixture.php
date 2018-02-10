<?php
/**
 * Created by PhpStorm.
 * User: amacabr2
 * Date: 28/11/17
 * Time: 12:23
 */

namespace CovoiturageBundle\DataFixtures\ORM;


use CovoiturageBundle\Entity\Trajet;
use Doctrine\Common\Persistence\ObjectManager;
use UserBundle\DataFixtures\FakerFixture;
use UserBundle\DataFixtures\ORM\UserFixture;

class TrajetFixture extends FakerFixture {

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager) {
        $users = $manager->getRepository('UserBundle:User')->findAll();
        $localisations = $manager->getRepository('CovoiturageBundle:Localisation')->findAll();
        $vehicules = $manager->getRepository('CovoiturageBundle:Vehicule')->findAll();

        for ($i = 0; $i < 30; $i++) {
            $trajet = new Trajet();
            $trajet->setUserDemandeur($users[$i]);
            $trajet->setUserConducteur($users[$i]);
            $trajet->setNbPlaceRestante(4);
            $trajet->addLocalisation($localisations[$i + 30]);
            $trajet->addLocalisation($localisations[$i + 60]);
            $trajet->setVehicule($vehicules[$i]);

            $manager->persist($trajet);
        }

        $manager->flush();
    }

    /**
     * @return array
     */
    public function getDependencies(): array {
        return [
            UserFixture::class,
            LocalisationFixture::class,
            VehiculeFixture::class
        ];
    }
}
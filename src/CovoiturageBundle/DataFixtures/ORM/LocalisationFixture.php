<?php
/**
 * Created by PhpStorm.
 * User: amacabr2
 * Date: 29/11/17
 * Time: 18:34
 */

namespace CovoiturageBundle\DataFixtures\ORM;


use CovoiturageBundle\Entity\Localisation;
use Doctrine\Common\Persistence\ObjectManager;
use UserBundle\DataFixtures\FakerFixture;

class LocalisationFixture extends FakerFixture {

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager) {
        for ($i = 0; $i < 90; $i++) {
            if ($i < 30) {
                $isDepart = false;
                $isArrive = false;
            } else {
                $isDepart = (bool)rand(0, 1);
                $isArrive = !$isDepart;
            }

            $localisation = new Localisation();
            $localisation->setAdresse($this->getFaker()->streetAddress);
            $localisation->setVille($this->getFaker()->city);
            $localisation->setCodePostal($this->getFaker()->postcode);
            $localisation->setPays("France");
            $localisation->setLatitude($this->getFaker()->latitude(-5, 8));
            $localisation->setLongitude($this->getFaker()->longitude(40, 50));
            $localisation->setIsDepart($isDepart);
            $localisation->setIsArrivee($isArrive);

            $manager->persist($localisation);
        }

        $manager->flush();
    }
}
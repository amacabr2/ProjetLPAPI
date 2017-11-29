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
     * @var Localisation[]
     */
    private static $localisations = [];

    /**
     * @return Localisation[]
     */
    public static function getLocalisations(): array {
        return self::$localisations;
    }

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager) {
        for ($i = 0; $i < 50; $i++) {
            $isDepart = (bool)rand(0, 1);

            $localisation = new Localisation();
            $localisation->setAdresse($this->getFaker()->streetAddress);
            $localisation->setVille($this->getFaker()->city);
            $localisation->setPays("France");
            $localisation->setLatitude($this->getFaker()->latitude(-5, 8));
            $localisation->setLongitude($this->getFaker()->longitude(40, 50));
            $localisation->setIsDepart($isDepart);
            $localisation->setIsArrivee(!$isDepart);

            $manager->persist($localisation);
            self::$localisations[] = $localisation;
        }

        $manager->flush();
    }
}
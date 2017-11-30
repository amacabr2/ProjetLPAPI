<?php
/**
 * Created by PhpStorm.
 * User: amacabr2
 * Date: 29/11/17
 * Time: 18:33
 */

namespace CovoiturageBundle\DataFixtures\ORM;


use CovoiturageBundle\Entity\Energie;
use Doctrine\Common\Persistence\ObjectManager;
use UserBundle\DataFixtures\FakerFixture;

class EnergieFixture extends FakerFixture {

    /**
     * @var Energie[]
     */
    private static $energies = [];

    /**
     * @return Energie[]
     */
    public static function getEnergies(): array {
        return self::$energies;
    }

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager) {
        $energies = ["essence", "diesel", "fioul", "electrique", "hybryde"];

        for ($i = 0; $i < sizeof($energies); $i++) {
            $energie = new Energie();
            $energie->setLibelle($energies[$i]);

            self::$energies[] = $energie;
            $manager->persist($energie);
        }

        $manager->flush();
    }
}
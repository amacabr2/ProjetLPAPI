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
     * @var Etat[]
     */
    private static $etats;

    /**
     * @return Etat[]
     */
    public static function getEtats(): array {
        return self::$etats;
    }

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager) {
        $etats = ["bon", "moyen", "mauvais", "delabré"];

        for ($i = 0; sizeof($etats); $i++) {
            $etat = new Etat();
            $etat->setLabel($etats[$i]);

            self::$etats[] = $etat;
            $manager->persist($etat);
        }

        $manager->flush();
    }
}
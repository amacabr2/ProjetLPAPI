<?php
/**
 * Created by PhpStorm.
 * User: amacabr2
 * Date: 29/11/17
 * Time: 18:34
 */

namespace CovoiturageBundle\DataFixtures\ORM;


use CovoiturageBundle\Entity\Permis;
use Doctrine\Common\Persistence\ObjectManager;
use UserBundle\DataFixtures\FakerFixture;

class PermisFixture extends FakerFixture {

    /**
     * @var Permis[]
     */
    private static $permis = [];

    /**
     * @return Permis[]
     */
    public static function getPermis(): array {
        return self::$permis;
    }

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager) {
        for ($i = 0; $i < 30; $i++) {
            $permis = new Permis();
            $permis->setDateObtention(new \DateTime($this->getFaker()->date($format = 'Y-m-d', $max = 'now')));
            $permis->setValide(true);
            $permis->setFichier($this->getFaker()->imageUrl($width = 640, $height = 480));

            self::$permis[] = $permis;
            $manager->persist($permis);
        }

        $manager->flush();
    }
}
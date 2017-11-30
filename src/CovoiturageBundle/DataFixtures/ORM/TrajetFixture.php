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
        for ($i = 0; $i < 30; $i++) {
            $trajet = new Trajet();
            $trajet->setUserConducteur($this->getUser($i));
            $trajet->setNbPlaceRestante(4);

            self::$trajets[] = $trajet;
            $manager->merge($trajet);
        }

        $manager->flush();
    }

    /**
     * @return array
     */
    public function getDependencies(): array {
        return [
            UserFixture::class,
            LocalisationFixture::class
        ];
    }

    /**
     * @param int $i
     * @return User
     */
    private function getUser(int $i): User {
        return UserFixture::getUsers()[$i];
    }
}
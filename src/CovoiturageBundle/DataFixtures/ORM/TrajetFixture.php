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
     * @var ObjectManager
     */
    private $manager;

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager) {
        $this->manager = $manager;

        for ($i = 0; $i < 20; $i++) {
            $trajet = new Trajet();
            $trajet->setUserConducteur($this->buildUser());
            $trajet->setNbPlaceRestante(random_int(0, 3));
            $trajet->addLocalisation($this->buildLocalisation(true));
            $trajet->addLocalisation($this->buildLocalisation(false, true));
            $manager->persist($trajet);
        }

        $manager->flush();
    }

    /**
     * @param bool|null $depart
     * @param bool|null $arrivee
     * @return Localisation
     */
    private function buildLocalisation(?bool $depart = false, ?bool $arrivee = false): Localisation {
        $localisation = new Localisation();
        $localisation->setAdresse($this->getFaker()->address);
        $localisation->setVille($this->getFaker()->city);
        $localisation->setPays("France");
        $localisation->setLatitude($this->getFaker()->latitude(-5, 8));
        $localisation->setLongitude($this->getFaker()->longitude(40, 50));
        $localisation->setIsDepart($depart);
        $localisation->setIsArrivee($arrivee);

        $this->manager->persist($localisation);
        return $localisation;
    }

    /**
     * @return User
     */
    private function buildUser(): User {
        return new User();
    }

    private function buildVehicule(User $user): Vehicule {
        $vehicule = new Vehicule();
        $vehicule->setMarque("Bugati");
        $vehicule->setModele("Le meilleur");
        $vehicule->setCouleur("Vert");
        $vehicule->addUser($user);
    }
}
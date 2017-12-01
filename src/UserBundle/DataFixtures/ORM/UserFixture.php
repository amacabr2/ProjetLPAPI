<?php
/**
 * Created by PhpStorm.
 * User: amacabr2
 * Date: 29/11/17
 * Time: 18:36
 */

namespace UserBundle\DataFixtures\ORM;

use CovoiturageBundle\DataFixtures\ORM\LocalisationFixture;
use CovoiturageBundle\DataFixtures\ORM\PermisFixture;
use CovoiturageBundle\DataFixtures\ORM\VehiculeFixture;
use CovoiturageBundle\Entity\Localisation;
use CovoiturageBundle\Entity\Permis;
use CovoiturageBundle\Entity\Vehicule;
use Doctrine\Common\Persistence\ObjectManager;
use UserBundle\DataFixtures\FakerFixture;
use UserBundle\Entity\User;

class UserFixture extends FakerFixture {

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager) {
        $permis = $manager->getRepository('CovoiturageBundle:Permis')->findAll();
        $localisations = $manager->getRepository('CovoiturageBundle:Localisation')->findAll();
        $vehicules = $manager->getRepository('CovoiturageBundle:Vehicule')->findAll();

        for ($i = 0; $i < 30; $i++) {
            $randomSex = random_int(0, 1);
            $prenom = $randomSex ? $this->getFaker()->firstnameMale : $this->getFaker()->firstnameFemale;
            $nom = $this->getFaker()->lastname;
            $dateNaissance = $this->getFaker()->date($format = 'Y-m-d', $max = 'now');

            $user = new User();
            $user->setCivilite($randomSex ? "Monsieur" : "Madame");
            $user->setUsername($this->getFaker()->username . $i);
            $user->setPrenom($prenom);
            $user->setNom($nom);
            $user->setEmail($prenom . "." . $nom . "@gmail.com");
            $user->setDateNaissance($dateNaissance);
            $user->setPlainPassword("azerty");
            $user->setTelFixe($this->getFaker()->phoneNumber);
            $user->setTelPortable($this->getFaker()->e164PhoneNumber);
            $user->setFichier($this->getFaker()->imageUrl($width = 640, $height = 480));
            $user->setNewsletter((bool)rand(0, 1));
            $user->setPresentation($this->getFaker()->realText($maxNbChars = 200, $indexSize = 2));
            $user->setCreatedAt();
            $user->setPermis($permis[$i]);
            $user->setLocalisations($localisations[$i]);
            $user->addVehicule($vehicules[$i]);

            $manager->persist($user);
        }

        $manager->flush();
    }

    /**
     * @return array
     */
    public function getDependencies(): array {
        return [
            PermisFixture::class,
            LocalisationFixture::class,
            VehiculeFixture::class
        ];
    }
}
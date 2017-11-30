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
use CovoiturageBundle\Entity\Localisation;
use CovoiturageBundle\Entity\Permis;
use Doctrine\Common\Persistence\ObjectManager;
use UserBundle\DataFixtures\FakerFixture;
use UserBundle\Entity\User;

class UserFixture extends FakerFixture {

    /**
     * @var User[]
     */
    private static $users = [];

    /**
     * @return User[]
     */
    public static function getUsers(): array {
        return self::$users;
    }

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager) {
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
            $user->setPermis($this->getPermis($i));
            $user->setLocalisations($this->getLocalisation($i));

            self::$users[] = $user;
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
            LocalisationFixture::class
        ];
    }

    /**
     * @param int $i
     * @return Permis
     */
    private function getPermis(int $i): Permis {
        return PermisFixture::getPermis()[$i];
    }

    /**
     * @param int $i
     * @return Localisation
     */
    private function getLocalisation(int $i): Localisation {
        return LocalisationFixture::getLocalisations()[$i];
    }
}
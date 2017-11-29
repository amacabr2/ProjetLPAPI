<?php
/**
 * Created by PhpStorm.
 * User: amacabr2
 * Date: 29/11/17
 * Time: 18:36
 */

namespace UserBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use UserBundle\DataFixtures\FakerFixture;
use UserBundle\Entity\User;

class UserFixtures extends FakerFixture {

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
        for ($i = 0; $i < 50; $i++) {
            $randomSex = random_int(0, 1);
            $prenom = $randomSex ? $this->getFaker()->firstnameMale : $this->getFaker()->firstnameFemale;
            $nom = $this->getFaker()->lastname;
            $dateNaissance = $this->getFaker()->date($format = 'Y-m-d', $max = 'now');

            $user = new User();
            $user->setCivilite($randomSex ? "Monsieur" : "Madame");
            $user->setUsername($this->getFaker()->username);
            $user->setPrenom($prenom);
            $user->setNom($nom);
            $user->setEmail($prenom . "." . $nom . "@gmail.com");
            $user->setDateNaissance($dateNaissance);
            $user->setPlainPassword("azerty");
            $user->setTelFixe($this->getFaker()->phoneNumber);
            $user->setTelPortable($this->getFaker()->e164PhoneNumber);
            $user->setFichier($this->getFaker()->imageUrl($width = 640, $height = 480));
            $user->setNewsletter((bool)rand(0,1));
            $user->setPresentation($this->getFaker()->realText($maxNbChars = 200, $indexSize = 2));
            $user->setCreatedAt($this->buildCreatedAt($dateNaissance));

            self::$users = $user;
            $manager->persist($user);
        }

        $manager->flush();
    }


    /**
     * @param $dateNaissance
     * @return \DateTime
     */
    private function buildCreatedAt($dateNaissance): \DateTime{
        $dateNaissance = new \DateTime($dateNaissance);

        do {
            $dateCreatedAt = $this->getFaker()->date($format = 'Y-m-d', $max = 'now');
        } while($dateCreatedAt < $dateNaissance->add(\DateInterval::createFromDateString("18 years")));

        return $dateCreatedAt;
    }
}
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
     * @var User
     */
    private $user;

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager) {
        $randomSex = random_int(0, 1);
        $prenom = $randomSex ? $this->getFaker()->firstnameMale : $this->getFaker()->firstnameFemale;
        $nom = $this->getFaker()->lastname;
        $dateNaissance = $this->getFaker()->date($format = 'Y-m-d', $max = 'now');

        $this->user = new User();
        $this->user->setCivilite($randomSex ? "Monsieur" : "Madame");
        $this->user->setUsername($this->getFaker()->username);
        $this->user->setPrenom($prenom);
        $this->user->setNom($nom);
        $this->user->setEmail($prenom . "." . $nom . "@gmail.com");
        $this->user->setDateNaissance($dateNaissance);
        $this->user->setPlainPassword("azerty");
        $this->user->setTelFixe($this->getFaker()->phoneNumber);
        $this->user->setTelPortable($this->getFaker()->e164PhoneNumber);
        $this->user->setFichier($this->getFaker()->imageUrl($width = 640, $height = 480));
        $this->user->setNewsletter((bool)rand(0,1));
        $this->user->setPresentation($this->getFaker()->realText($maxNbChars = 200, $indexSize = 2));
        $this->user->setCreatedAt($this->buildCreatedAt($dateNaissance));

        $manager->persist($this->user);
        $manager->flush();
    }

    /**
     * @return User
     */
    public function getUser(): User {
        return $this->user;
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
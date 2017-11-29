<?php
/**
 * Created by PhpStorm.
 * User: amacabr2
 * Date: 29/11/17
 * Time: 18:32
 */

namespace CovoiturageBundle\DataFixtures\ORM;


use CovoiturageBundle\Entity\Assurance;
use Doctrine\Common\Persistence\ObjectManager;
use UserBundle\DataFixtures\FakerFixture;

class AssuranceFixture extends FakerFixture {

    /**
     * @var Assurance
     */
    private $assurance;

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager) {
        $this->assurance->setFichier($this->getFaker()->imageUrl($width = 640, $height = 480));
        $this->assurance->setValide(true);
        $this->assurance->setDateObtention($this->getFaker()->date($format = 'Y-m-d', $max = 'now'));

        $manager->persist($this->assurance);
        $manager->flush();
    }

    /**
     * @return Assurance
     */
    public function getAssurance(): Assurance {
        return $this->assurance;
    }
}
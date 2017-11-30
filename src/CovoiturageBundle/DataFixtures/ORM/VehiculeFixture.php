<?php
/**
 * Created by PhpStorm.
 * User: amacabr2
 * Date: 29/11/17
 * Time: 18:35
 */

namespace CovoiturageBundle\DataFixtures\ORM;


use CovoiturageBundle\Entity\Assurance;
use CovoiturageBundle\Entity\Energie;
use CovoiturageBundle\Entity\Etat;
use CovoiturageBundle\Entity\Vehicule;
use Doctrine\Common\Persistence\ObjectManager;
use UserBundle\DataFixtures\FakerFixture;

class VehiculeFixture extends FakerFixture {

    /**
     * @var Vehicule[]
     */
    private static $vehicules = [];

    /**
     * @return Vehicule[]
     */
    public static function getVehicules(): array {
        return self::$vehicules;
    }

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager) {
        for ($i = 0; $i < 30; $i++) {
            $marque = $this->getMarque();

            $vehicule = new Vehicule();
            $vehicule->setFichier($this->getFaker()->imageUrl($width = 640, $height = 480));
            $vehicule->setCouleur($this->getFaker()->safeColorName);
            $vehicule->setMarque($marque);
            $vehicule->setModele($marque . "_modele");
            $vehicule->setImmatriculation($this->getImmatriculation());
            $vehicule->setNbPlace(4);
            $vehicule->setPuissanceChevaux(random_int(80, 160));
            $vehicule->setEnergies($this->getEnergie());
            $vehicule->setEtats($this->getEtat());
            $vehicule->setAssurances($this->getAssurance($i));

            self::$vehicules[] = $vehicule;
            $manager->merge($vehicule);
        }

        $manager->flush();
    }

    /**
     * @return array
     */
    public function getDependencies(): array {
        return [
            EnergieFixture::class,
            EtatFixture::class,
            AssuranceFixture::class
        ];
    }

    /**
     * @return String
     */
    private function getMarque(): String {
        $marques = ["Renault", "Peugeot", "Citroen", "Volkswagen", "Audi", "Nissan", "Mercedes-Benz", "Opel", "Ford", "BMW", "Toyota"];
        return $marques[random_int(0, sizeof($marques) - 1)];
    }

    /**
     * @return String
     */
    private function getImmatriculation(): String {
        $lettres = [];
        for ($i = 0; $i < 4; $i++) {
            $lettres[] = chr(random_int(1, 26));
        }

        $chiffres = [];
        for ($i = 0; $i < 3; $i++) {
            $chiffres[] = random_int(0, 9);
        }

        return $lettres[0] . $lettres[1] . '-' . $chiffres[0] . $chiffres[0] . $chiffres[2] . '-' . $lettres[2] . $lettres[3];
    }

    /**
     * @return Energie
     */
    private function getEnergie(): Energie {
        $energies = EnergieFixture::getEnergies();
        return $energies[random_int(0, sizeof($energies) - 1)];
    }

    /**
     * @return Etat
     */
    private function getEtat(): Etat {
        $etats = EtatFixture::getEtats();
        return $etats[random_int(0, sizeof($etats) - 1)];
    }

    /**
     * @param int $i
     * @return Assurance
     */
    private function getAssurance(int $i): Assurance {
        return AssuranceFixture::getAssurances()[$i];
    }
}
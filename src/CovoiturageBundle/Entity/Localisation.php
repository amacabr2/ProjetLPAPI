<?php

namespace CovoiturageBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
use JsonSerializable;

/**
 * Localisation
 *
 * @ORM\Table(name="localisations")
 * @ORM\Entity
 */
class Localisation implements JsonSerializable {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse", type="string", length=255, nullable=true)
     *
     * @Serializer\Groups({"localisation_always"})
     */
    private $adresse;

    /**
     * @var string
     *
     * @ORM\Column(name="ville", type="string", length=255, nullable=true)
     *
     * @Serializer\Groups({"localisation_always"})
     */
    private $ville;

    /**
     * @var string
     *
     * @ORM\Column(name="codePostal", type="string", length=20, nullable=true)
     *
     * @Serializer\Groups({"localisation_always"})
     */
    private $codePostal;

    /**
     * @var string
     *
     * @ORM\Column(name="pays", type="string", length=255, nullable=true)
     *
     * @Serializer\Groups({"localisation_always"})
     */
    private $pays;

    /**
     * @var float
     *
     * @ORM\Column(name="latitude", type="float", precision=10, scale=6, nullable=true)
     *
     * @Serializer\Groups({"localisation_always"})
     */
    private $latitude;

    /**
     * @var float
     *
     * @ORM\Column(name="longitude", type="float", precision=10, scale=6, nullable=true)
     *
     * @Serializer\Groups({"localisation_always"})
     */
    private $longitude;

    /**
     * @var boolean
     *
     * @ORM\Column(name="isDepart", type="boolean", nullable=true)
     *
     * @Serializer\Groups({"localisation_always"})
     */
    private $isDepart;

    /**
     * @var boolean
     *
     * @ORM\Column(name="isArrive", type="boolean", nullable=true)
     *
     * @Serializer\Groups({"localisation_always"})
     */
    private $isArrivee;

    /**
     * @var Trajet[]
     *
     * @ORM\ManyToMany(targetEntity="CovoiturageBundle\Entity\Trajet", mappedBy="localisations")
     */
    private $trajets;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="horaire", type="datetime", nullable=true)
     *
     * @Serializer\Groups({"localisation_always"})
     */
    private $horaire;

    /**
     * Constructor
     */
    public function __construct() {
        $this->trajets = new ArrayCollection();
    }

    /**
     * Get adresse
     *
     * @return string
     */
    public function getAdresse(): string {
        return $this->adresse;
    }

    /**
     * Set adresse
     *
     * @param string $adresse
     *
     * @return Localisation
     */
    public function setAdresse(string $adresse): self {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * Get ville
     *
     * @return string
     */
    public function getVille(): string {
        return $this->ville;
    }

    /**
     * Set ville
     *
     * @param string $ville
     *
     * @return Localisation
     */
    public function setVille(string $ville): self {
        $this->ville = $ville;

        return $this;
    }

    /**
     * Get pays
     *
     * @return string
     */
    public function getPays(): string {
        return $this->pays;
    }

    /**
     * Set pays
     *
     * @param string $pays
     *
     * @return Localisation
     */
    public function setPays(string $pays): self {
        $this->pays = $pays;

        return $this;
    }

    /**
     * Get latitude
     *
     * @return float
     */
    public function getLatitude(): float {
        return $this->latitude;
    }

    /**
     * Set latitude
     *
     * @param float $latitude
     *
     * @return Localisation
     */
    public function setLatitude(float $latitude): self {
        $this->latitude = $latitude;

        return $this;
    }

    /**
     * Get longitude
     *
     * @return float
     */
    public function getLongitude(): float {
        return $this->longitude;
    }

    /**
     * Set longitude
     *
     * @param float $longitude
     *
     * @return Localisation
     */
    public function setLongitude(float $longitude): self {
        $this->longitude = $longitude;

        return $this;
    }

    /**
     * Get isdepart
     *
     * @return boolean
     */
    public function getIsDepart(): bool {
        return $this->isDepart;
    }

    /**
     * Set isdepart
     *
     * @param boolean $isDepart
     *
     * @return Localisation
     */
    public function setIsDepart(bool $isDepart): self {
        $this->isDepart = $isDepart;

        return $this;
    }

    /**
     * Get isarrive
     *
     * @return boolean
     */
    public function getIsArrivee(): bool {
        return $this->isArrivee;
    }

    /**
     * Set isarrive
     *
     * @param boolean $isArrivee
     *
     * @return Localisation
     */
    public function setIsArrivee(bool $isArrivee): self {
        $this->isArrivee = $isArrivee;

        return $this;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId(): int {
        return $this->id;
    }

    /**
     * Add trajet
     *
     * @param \CovoiturageBundle\Entity\Trajet $trajet
     * @return Localisation
     *
     */
    public function addTrajet(Trajet $trajet): self {
        $this->trajets[] = $trajet;

        return $this;
    }

    /**
     * Remove trajet
     *
     * @param Trajet $trajet
     */
    public function removeTrajet(Trajet $trajet) {
        $this->trajets->removeElement($trajet);
    }

    /**
     * Get trajets
     *
     * @return array
     */
    public function getTrajets(): array {
        return $this->trajets;
    }

    /**
     * Get codePostal
     *
     * @return string
     */
    public function getCodePostal() {
        return $this->codePostal;
    }

    /**
     * Set codePostal
     *
     * @param string $codePostal
     *
     * @return Localisation
     */
    public function setCodePostal($codePostal) {
        $this->codePostal = $codePostal;

        return $this;
    }

    /**
     * Get horaire
     *
     * @return \DateTime
     */
    public function getHoraire() {
        return $this->horaire;
    }

    /**
     * Set horaire
     *
     * @param \DateTime $horaire
     *
     * @return Localisation
     */
    public function setHoraire($horaire) {
        $this->horaire = $horaire;

        return $this;
    }

    /**
     * Specify data which should be serialized to JSON
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    public function jsonSerialize() {
        return [
            'id' => $this->id,
            'adresse' => $this->adresse,
            'ville' => $this->ville,
            'code_postal' => $this->codePostal,
            'pays' => $this->pays,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'is_depart' => $this->isDepart,
            'is_arrivee' => $this->isArrivee,
            'horaire' => $this->horaire
        ];
    }

    /**
     * Désérialisation de l'objet
     *
     * @param array $object
     * @return Localisation
     */
    public static function jsonDeserialize(array $object) {
//        dump($object['horaire']); die;
        $localisation = new Localisation();
        //$localisation->id = $object['id'];
        $localisation->adresse = $object['adresse'];
        $localisation->ville = $object['ville'];
        $localisation->codePostal = $object['code_postal'];
        $localisation->pays = $object['pays'];
        $localisation->latitude = $object['latitude'];
        $localisation->longitude = $object['longitude'];
        $localisation->isDepart = $object['is_depart'];
        $localisation->isArrivee = $object['is_arrivee'];
        $localisation->horaire = new \DateTime($object['horaire']);

        return $localisation;
    }
}

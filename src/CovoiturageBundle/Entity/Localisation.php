<?php

namespace CovoiturageBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Localisation
 *
 * @ORM\Table(name="localisations")
 * @ORM\Entity
 */
class Localisation
{
    /**
     * @var string
     *
     * @ORM\Column(name="adresse", type="string", length=255, nullable=true)
     */
    private $adresse;

    /**
     * @var string
     *
     * @ORM\Column(name="ville", type="string", length=255, nullable=true)
     */
    private $ville;

    /**
     * @var string
     *
     * @ORM\Column(name="pays", type="string", length=255, nullable=true)
     */
    private $pays;

    /**
     * @var float
     *
     * @ORM\Column(name="latitude", type="float", precision=10, scale=6, nullable=true)
     */
    private $latitude;

    /**
     * @var float
     *
     * @ORM\Column(name="longitude", type="float", precision=10, scale=6, nullable=true)
     */
    private $longitude;

    /**
     * @var boolean
     *
     * @ORM\Column(name="isDepart", type="boolean", nullable=true)
     */
    private $isDepart;

    /**
     * @var boolean
     *
     * @ORM\Column(name="isArrive", type="boolean", nullable=true)
     */
    private $isArrivee;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="CovoiturageBundle\Entity\Trajet", mappedBy="localisations")
     */
    private $trajets;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->trajets = new ArrayCollection();
    }


    /**
     * Set adresse
     *
     * @param string $adresse
     *
     * @return Localisation
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * Get adresse
     *
     * @return string
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * Set ville
     *
     * @param string $ville
     *
     * @return Localisation
     */
    public function setVille($ville)
    {
        $this->ville = $ville;

        return $this;
    }

    /**
     * Get ville
     *
     * @return string
     */
    public function getVille()
    {
        return $this->ville;
    }

    /**
     * Set pays
     *
     * @param string $pays
     *
     * @return Localisation
     */
    public function setPays($pays)
    {
        $this->pays = $pays;

        return $this;
    }

    /**
     * Get pays
     *
     * @return string
     */
    public function getPays()
    {
        return $this->pays;
    }

    /**
     * Set latitude
     *
     * @param float $latitude
     *
     * @return Localisation
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;

        return $this;
    }

    /**
     * Get latitude
     *
     * @return float
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * Set longitude
     *
     * @param float $longitude
     *
     * @return Localisation
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;

        return $this;
    }

    /**
     * Get longitude
     *
     * @return float
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * Set isdepart
     *
     * @param boolean $isDepart
     *
     * @return Localisation
     */
    public function setIsDepart($isDepart)
    {
        $this->isDepart = $isDepart;

        return $this;
    }

    /**
     * Get isdepart
     *
     * @return boolean
     */
    public function getIsDepart()
    {
        return $this->isDepart;
    }

    /**
     * Set isarrive
     *
     * @param boolean $isArrivee
     *
     * @return Localisation
     */
    public function setIsArrivee($isArrivee)
    {
        $this->isArrivee = $isArrivee;

        return $this;
    }

    /**
     * Get isarrive
     *
     * @return boolean
     */
    public function getIsArrivee()
    {
        return $this->isArrivee;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Add trajet
     *
     * @param \CovoiturageBundle\Entity\Trajet $trajet
     * @return Localisation
     *
     */
    public function addTrajet(Trajet $trajet)
    {
        $this->trajets[] = $trajet;

        return $this;
    }

    /**
     * Remove trajet
     *
     * @param Trajet $trajet
     */
    public function removeTrajet(Trajet $trajet)
    {
        $this->trajets->removeElement($trajet);
    }

    /**
     * Get trajets
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTrajets()
    {
        return $this->trajets;
    }
}

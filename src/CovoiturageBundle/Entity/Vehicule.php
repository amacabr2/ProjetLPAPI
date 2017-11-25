<?php

namespace CovoiturageBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use UserBundle\Entity\User;

/**
 * Vehicule
 *
 * @ORM\Table(name="vehicules", indexes={@ORM\Index(name="fk_vehicules_etats1_idx", columns={"etats_id"}), @ORM\Index(name="fk_vehicules_energies1_idx", columns={"energies_id"}), @ORM\Index(name="fk_vehicules_voitures1_idx", columns={"voitures_id"}), @ORM\Index(name="fk_vehicules_cyclomoteurs1_idx", columns={"cyclomoteurs_id"}), @ORM\Index(name="fk_vehicules_assurances1_idx", columns={"assurances_id"})})
 * @ORM\Entity
 */
class Vehicule
{
    /**
     * @var string
     *
     * @ORM\Column(name="marque", type="string", length=255, nullable=true)
     */
    private $marque;

    /**
     * @var string
     *
     * @ORM\Column(name="immatriculation", type="string", length=45, nullable=true)
     */
    private $immatriculation;

    /**
     * @var string
     *
     * @ORM\Column(name="modele", type="string", length=45, nullable=true)
     */
    private $modele;

    /**
     * @var string
     *
     * @ORM\Column(name="couleur", type="string", length=45, nullable=true)
     */
    private $couleur;

    /**
     * @var integer
     *
     * @ORM\Column(name="nb_place", type="integer", nullable=true)
     */
    private $nbPlace;

    /**
     * @var string
     *
     * @ORM\Column(name="fichier", type="string", length=255, nullable=true)
     */
    private $fichier;

    /**
     * @var string
     *
     * @ORM\Column(name="puissance_chevaux", type="string", length=45, nullable=true)
     */
    private $puissanceChevaux;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="types_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $typesId;

    /**
     * @var Assurance
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="CovoiturageBundle\Entity\Assurance")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="assurances_id", referencedColumnName="id")
     * })
     */
    private $assurances;

    /**
     * @var Cyclomoteur
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="CovoiturageBundle\Entity\Cyclomoteur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="cyclomoteurs_id", referencedColumnName="id")
     * })
     */
    private $cyclomoteurs;

    /**
     * @var Voiture
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="CovoiturageBundle\Entity\Voiture")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="voitures_id", referencedColumnName="id")
     * })
     */
    private $voitures;

    /**
     * @var Energie
     *
     * @ORM\ManyToOne(targetEntity="CovoiturageBundle\Entity\Energie")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="energies_id", referencedColumnName="id")
     * })
     */
    private $energies;

    /**
     * @var Etat
     *
     * @ORM\ManyToOne(targetEntity="CovoiturageBundle\Entity\Etat")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="etats_id", referencedColumnName="id")
     * })
     */
    private $etats;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="UserBundle\Entity\User", mappedBy="vehicules")
     */
    private $users;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->users = new ArrayCollection();
    }


    /**
     * Set marque
     *
     * @param string $marque
     *
     * @return Vehicule
     */
    public function setMarque($marque)
    {
        $this->marque = $marque;

        return $this;
    }

    /**
     * Get marque
     *
     * @return string
     */
    public function getMarque()
    {
        return $this->marque;
    }

    /**
     * Set immatriculation
     *
     * @param string $immatriculation
     *
     * @return Vehicule
     */
    public function setImmatriculation($immatriculation)
    {
        $this->immatriculation = $immatriculation;

        return $this;
    }

    /**
     * Get immatriculation
     *
     * @return string
     */
    public function getImmatriculation()
    {
        return $this->immatriculation;
    }

    /**
     * Set modele
     *
     * @param string $modele
     *
     * @return Vehicule
     */
    public function setModele($modele)
    {
        $this->modele = $modele;

        return $this;
    }

    /**
     * Get modele
     *
     * @return string
     */
    public function getModele()
    {
        return $this->modele;
    }

    /**
     * Set couleur
     *
     * @param string $couleur
     *
     * @return Vehicule
     */
    public function setCouleur($couleur)
    {
        $this->couleur = $couleur;

        return $this;
    }

    /**
     * Get couleur
     *
     * @return string
     */
    public function getCouleur()
    {
        return $this->couleur;
    }

    /**
     * Set nbPlace
     *
     * @param integer $nbPlace
     *
     * @return Vehicule
     */
    public function setNbPlace($nbPlace)
    {
        $this->nbPlace = $nbPlace;

        return $this;
    }

    /**
     * Get nbPlace
     *
     * @return integer
     */
    public function getNbPlace()
    {
        return $this->nbPlace;
    }

    /**
     * Set fichier
     *
     * @param string $fichier
     *
     * @return Vehicule
     */
    public function setFichier($fichier)
    {
        $this->fichier = $fichier;

        return $this;
    }

    /**
     * Get fichier
     *
     * @return string
     */
    public function getFichier()
    {
        return $this->fichier;
    }

    /**
     * Set puissanceChevaux
     *
     * @param string $puissanceChevaux
     *
     * @return Vehicule
     */
    public function setPuissanceChevaux($puissanceChevaux)
    {
        $this->puissanceChevaux = $puissanceChevaux;

        return $this;
    }

    /**
     * Get puissanceChevaux
     *
     * @return string
     */
    public function getPuissanceChevaux()
    {
        return $this->puissanceChevaux;
    }

    /**
     * Set id
     *
     * @param integer $id
     *
     * @return Vehicule
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
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
     * Set typesId
     *
     * @param integer $typesId
     *
     * @return Vehicule
     */
    public function setTypesId($typesId)
    {
        $this->typesId = $typesId;

        return $this;
    }

    /**
     * Get typesId
     *
     * @return integer
     */
    public function getTypesId()
    {
        return $this->typesId;
    }

    /**
     * Set assurances
     *
     * @param Assurance $assurances
     *
     * @return Vehicule
     */
    public function setAssurances(Assurance $assurances)
    {
        $this->assurances = $assurances;

        return $this;
    }

    /**
     * Get assurances
     *
     * @return Assurance.php
     */
    public function getAssurances()
    {
        return $this->assurances;
    }

    /**
     * Set cyclomoteurs
     *
     * @param \CovoiturageBundle\Entity\Cyclomoteur $cyclomoteurs
     * @return Vehicule
     *
     */
    public function setCyclomoteurs(Cyclomoteur $cyclomoteurs)
    {
        $this->cyclomoteurs = $cyclomoteurs;

        return $this;
    }

    /**
     * Get cyclomoteurs
     *
     * @return Cyclomoteur.php
     */
    public function getCyclomoteurs()
    {
        return $this->cyclomoteurs;
    }

    /**
     * Set voitures
     *
     * @param Voiture $voitures
     *
     * @return Vehicule
     */
    public function setVoitures(Voiture $voitures)
    {
        $this->voitures = $voitures;

        return $this;
    }

    /**
     * Get voitures
     *
     * @return Voiture.php
     */
    public function getVoitures()
    {
        return $this->voitures;
    }

    /**
     * Set energies
     *
     * @param \CovoiturageBundle\Entity\Energie|null $energies
     * @return Vehicule
     *
     */
    public function setEnergies(Energie $energies = null)
    {
        $this->energies = $energies;

        return $this;
    }

    /**
     * Get energies
     *
     * @return Energie.php
     */
    public function getEnergies()
    {
        return $this->energies;
    }

    /**
     * Set etats
     *
     * @param \CovoiturageBundle\Entity\Etat|null $etats
     * @return Vehicule
     */
    public function setEtats(Etat $etats = null)
    {
        $this->etats = $etats;

        return $this;
    }

    /**
     * Get etats
     *
     * @return Etat.php
     */
    public function getEtats()
    {
        return $this->etats;
    }

    /**
     * Add user
     *
     * @param User $user
     * @return Vehicule
     */
    public function addUser(User $user)
    {
        $this->users[] = $user;

        return $this;
    }

    /**
     * Remove user
     *
     * @param User $user
     */
    public function removeUser(User $user)
    {
        $this->users->removeElement($user);
    }

    /**
     * Get users
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUsers()
    {
        return $this->users;
    }
}

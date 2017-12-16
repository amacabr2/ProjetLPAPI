<?php

namespace CovoiturageBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
use UserBundle\Entity\User;

/**
 * Vehicule
 *
 * @ORM\Table(name="vehicules", indexes={@ORM\Index(name="fk_vehicules_etats1_idx", columns={"etats_id"}), @ORM\Index(name="fk_vehicules_energies1_idx", columns={"energies_id"}), @ORM\Index(name="fk_vehicules_assurances1_idx", columns={"assurances_id"})})
 * @ORM\Entity
 */
class Vehicule {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     *
     * @Serializer\Groups({"vehicule_always"})
     */
    private $id;


    /**
     * @var string
     *
     * @ORM\Column(name="marque", type="string", length=255, nullable=true)
     *
     * @Serializer\Groups({"vehicule_always"})
     */
    private $marque;

    /**
     * @var string
     *
     * @ORM\Column(name="immatriculation", type="string", length=45, nullable=true)
     *
     * @Serializer\Groups({"vehicule_always"})
     */
    private $immatriculation;

    /**
     * @var string
     *
     * @ORM\Column(name="modele", type="string", length=45, nullable=true)
     *
     * @Serializer\Groups({"vehicule_always"})
     */
    private $modele;

    /**
     * @var string
     *
     * @ORM\Column(name="couleur", type="string", length=45, nullable=true)
     *
     * @Serializer\Groups({"vehicule_always"})
     */
    private $couleur;

    /**
     * @var integer
     *
     * @ORM\Column(name="nb_place", type="integer", nullable=true)
     *
     * @Serializer\Groups({"vehicule_always"})
     */
    private $nbPlace;

    /**
     * @var string
     *
     * @ORM\Column(name="fichier", type="string", length=255, nullable=true)
     *
     * @Serializer\Groups({"vehicule_always"})
     */
    private $fichier;

    /**
     * @var string
     *
     * @ORM\Column(name="puissance_chevaux", type="string", length=45, nullable=true)
     *
     * @Serializer\Groups({"vehicule_always"})
     */
    private $puissanceChevaux;

    /**
     * @var Assurance
     *
     * @ORM\OneToOne(targetEntity="CovoiturageBundle\Entity\Assurance")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="assurances_id", referencedColumnName="id")
     * })
     *
     * @Serializer\Groups({"vehicule_always"})
     */
    private $assurances;

    /**
     * @var Energie
     *
     * @ORM\ManyToOne(targetEntity="CovoiturageBundle\Entity\Energie")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="energies_id", referencedColumnName="id")
     * })
     *
     * @Serializer\Groups({"vehicule_always"})
     */
    private $energies;

    /**
     * @var Etat
     *
     * @ORM\ManyToOne(targetEntity="CovoiturageBundle\Entity\Etat")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="etats_id", referencedColumnName="id")
     * })
     *
     * @Serializer\Groups({"vehicule_always"})
     */
    private $etats;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="UserBundle\Entity\User", mappedBy="vehicules")
     *
     * @Serializer\Groups({"vehicule_users"}))
     */
    private $users;

    /**
     * Constructor
     */
    public function __construct() {
        $this->users = new ArrayCollection();
    }

    /**
     * Get marque
     *
     * @return string
     */
    public function getMarque(): string {
        return $this->marque;
    }

    /**
     * Set marque
     *
     * @param string $marque
     *
     * @return Vehicule
     */
    public function setMarque(string $marque): self {
        $this->marque = $marque;

        return $this;
    }

    /**
     * Get immatriculation
     *
     * @return string
     */
    public function getImmatriculation(): string {
        return $this->immatriculation;
    }

    /**
     * Set immatriculation
     *
     * @param string $immatriculation
     *
     * @return Vehicule
     */
    public function setImmatriculation($immatriculation): self {
        $this->immatriculation = $immatriculation;

        return $this;
    }

    /**
     * Get modele
     *
     * @return string
     */
    public function getModele(): string {
        return $this->modele;
    }

    /**
     * Set modele
     *
     * @param string $modele
     *
     * @return Vehicule
     */
    public function setModele(string $modele) {
        $this->modele = $modele;

        return $this;
    }

    /**
     * Get couleur
     *
     * @return string
     */
    public function getCouleur(): string {
        return $this->couleur;
    }

    /**
     * Set couleur
     *
     * @param string $couleur
     *
     * @return Vehicule
     */
    public function setCouleur(string $couleur): self {
        $this->couleur = $couleur;

        return $this;
    }

    /**
     * Get nbPlace
     *
     * @return integer
     */
    public function getNbPlace(): int {
        return $this->nbPlace;
    }

    /**
     * Set nbPlace
     *
     * @param integer $nbPlace
     *
     * @return Vehicule
     */
    public function setNbPlace(int $nbPlace): self {
        $this->nbPlace = $nbPlace;

        return $this;
    }

    /**
     * Get fichier
     *
     * @return string
     */
    public function getFichier(): string {
        return $this->fichier;
    }

    /**
     * Set fichier
     *
     * @param string $fichier
     *
     * @return Vehicule
     */
    public function setFichier(string $fichier): self {
        $this->fichier = $fichier;

        return $this;
    }

    /**
     * Get puissanceChevaux
     *
     * @return string
     */
    public function getPuissanceChevaux(): string {
        return $this->puissanceChevaux;
    }

    /**
     * Set puissanceChevaux
     *
     * @param string $puissanceChevaux
     *
     * @return Vehicule
     */
    public function setPuissanceChevaux($puissanceChevaux): self {
        $this->puissanceChevaux = $puissanceChevaux;

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
     * Set id
     *
     * @param integer $id
     *
     * @return Vehicule
     */
    public function setId($id): self {
        $this->id = $id;

        return $this;
    }

    /**
     * Get assurances
     *
     * @return Assurance
     */
    public function getAssurances(): Assurance {
        return $this->assurances;
    }

    /**
     * Set assurances
     *
     * @param Assurance $assurances
     *
     * @return Vehicule
     */
    public function setAssurances(Assurance $assurances): self {
        $this->assurances = $assurances;

        return $this;
    }

    /**
     * Get energies
     *
     * @return Energie
     */
    public function getEnergies(): Energie {
        return $this->energies;
    }

    /**
     * Set energies
     *
     * @param \CovoiturageBundle\Entity\Energie|null $energies
     * @return Vehicule
     *
     */
    public function setEnergies(Energie $energies = null): self {
        $this->energies = $energies;

        return $this;
    }

    /**
     * Get etats
     *
     * @return Etat
     */
    public function getEtats(): Etat {
        return $this->etats;
    }

    /**
     * Set etats
     *
     * @param \CovoiturageBundle\Entity\Etat|null $etats
     * @return Vehicule
     */
    public function setEtats(Etat $etats = null): self {
        $this->etats = $etats;

        return $this;
    }

    /**
     * Add user
     *
     * @param User $user
     * @return Vehicule
     */
    public function addUser(User $user): self {
        $this->users[] = $user;

        return $this;
    }

    /**
     * Remove user
     *
     * @param User $user
     */
    public function removeUser(User $user) {
        $this->users->removeElement($user);
    }

    /**
     * Get users
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUsers(): Collection {
        return $this->users;
    }
}

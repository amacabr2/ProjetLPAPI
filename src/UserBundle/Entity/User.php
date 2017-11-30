<?php

namespace UserBundle\Entity;

use CovoiturageBundle\Entity\Localisation;
use CovoiturageBundle\Entity\Permis;
use CovoiturageBundle\Entity\Trajet;
use CovoiturageBundle\Entity\Vehicule;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;

/**
 * User
 *
 * @ORM\Table(name="users", indexes={@ORM\Index(name="fk_users_permis_idx", columns={"permis_id"}), @ORM\Index(name="fk_users_localisations1_idx", columns={"localisations_id"})})
 * @ORM\Entity
 */
class User extends BaseUser {

    const ROLE_ADMIN = 'ROLE_ADMIN';

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="password_reset_token", type="string", nullable=true)
     */
    private $passwordResetToken;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=255, nullable=true)
     */
    private $prenom;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255, nullable=true)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="civilite", type="string", length=45, nullable=true)
     */
    private $civilite;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_naissance", type="date", length=45, nullable=true)
     */
    private $dateNaissance;

    /**
     * @var string
     *
     * @ORM\Column(name="tel_fixe", type="string", length=45, nullable=true)
     */
    private $telFixe;

    /**
     * @var string
     *
     * @ORM\Column(name="tel_portable", type="string", length=45, nullable=true)
     */
    private $telPortable;

    /**
     * @var string
     *
     * @ORM\Column(name="fichier", type="string", length=255, nullable=true)
     */
    private $fichier;

    /**
     * @var boolean
     *
     * @ORM\Column(name="newsletter", type="boolean", nullable=true)
     */
    private $newsletter;

    /**
     * @var string
     *
     * @ORM\Column(name="presentation", type="text", nullable=true)
     */
    private $presentation;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="date", nullable=true)
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="date", nullable=true)
     */
    private $updatedAt;

    /**
     * @var string
     *
     * @ORM\Column(name="role", type="string", length=45, nullable=true)
     */
    private $role;

    /**
     * @var Localisation
     *
     * @ORM\ManyToOne(targetEntity="CovoiturageBundle\Entity\Localisation", cascade={"persist"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="localisations_id", referencedColumnName="id")
     * })
     */
    private $localisations;

    /**
     * @var Permis
     *
     * @ORM\ManyToOne(targetEntity="CovoiturageBundle\Entity\Permis", cascade={"persist"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="permis_id", referencedColumnName="id")
     * })
     */
    private $permis;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="CovoiturageBundle\Entity\Trajet", mappedBy="users")
     */
    private $trajets;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="CovoiturageBundle\Entity\Vehicule", inversedBy="users")
     * @ORM\JoinTable(name="users_vehicules",
     *   joinColumns={
     *     @ORM\JoinColumn(name="users_id", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="vehicules_id", referencedColumnName="id")
     *   }
     * )
     */
    private $vehicules;

    /**
     * Constructor
     */
    public function __construct() {
        parent::__construct();
        $this->trajets = new ArrayCollection();
        $this->vehicules = new ArrayCollection();
    }

    /**
     * Get passwordResetToken
     *
     * @return string
     */
    public function getPasswordResetToken(): string {
        return $this->passwordResetToken;
    }

    /**
     * Set passwordResetToken
     *
     * @param string $passwordResetToken
     *
     * @return User
     */
    public function setPasswordResetToken(string $passwordResetToken): self {
        $this->passwordResetToken = $passwordResetToken;

        return $this;
    }

    /**
     * Get prenom
     *
     * @return string
     */
    public function getPrenom(): string {
        return $this->prenom;
    }

    /**
     * Set prenom
     *
     * @param string $prenom
     *
     * @return User
     */
    public function setPrenom(string $prenom): self {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom(): string {
        return $this->nom;
    }

    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return User
     */
    public function setNom(string $nom): self {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get civilite
     *
     * @return string
     */
    public function getCivilite(): string {
        return $this->civilite;
    }

    /**
     * Set civilite
     *
     * @param string $civilite
     *
     * @return User
     */
    public function setCivilite(string $civilite): self {
        $this->civilite = $civilite;

        return $this;
    }

    /**
     * Get dateNaissance
     *
     * @return \DateTime
     */
    public function getDateNaissance(): \DateTime {
        return $this->dateNaissance;
    }

    /**
     * Set dateNaissance
     *
     * @param string $dateNaissance
     *
     * @return User
     */
    public function setDateNaissance($dateNaissance): self {
        $this->dateNaissance = new \DateTime($dateNaissance);

        return $this;
    }

    /**
     * Get telFixe
     *
     * @return string
     */
    public function getTelFixe(): string {
        return $this->telFixe;
    }

    /**
     * Set telFixe
     *
     * @param string $telFixe
     *
     * @return User
     */
    public function setTelFixe($telFixe): self {
        $this->telFixe = $telFixe;

        return $this;
    }

    /**
     * Get telPortable
     *
     * @return string
     */
    public function getTelPortable(): string {
        return $this->telPortable;
    }

    /**
     * Set telPortable
     *
     * @param string $telPortable
     *
     * @return User
     */
    public function setTelPortable($telPortable): self {
        $this->telPortable = $telPortable;

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
     * @return User
     */
    public function setFichier($fichier): self {
        $this->fichier = $fichier;

        return $this;
    }

    /**
     * Get newsletter
     *
     * @return boolean
     */
    public function getNewsletter(): bool {
        return $this->newsletter;
    }

    /**
     * Set newsletter
     *
     * @param boolean $newsletter
     *
     * @return User
     */
    public function setNewsletter($newsletter): self {
        $this->newsletter = $newsletter;

        return $this;
    }

    /**
     * Get presentation
     *
     * @return string
     */
    public function getPresentation(): string {
        return $this->presentation;
    }

    /**
     * Set presentation
     *
     * @param string $presentation
     *
     * @return User
     */
    public function setPresentation($presentation): self {
        $this->presentation = $presentation;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt(): \DateTime {
        return $this->createdAt;
    }

    /**
     * Set createdAt
     *
     * @return User
     */
    public function setCreatedAt(): self {
        $this->createdAt = new \DateTime();

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt(): \DateTime {
        return $this->updatedAt;
    }

    /**
     * Set updatedAt
     *
     * @return User
     */
    public function setUpdatedAt(): self {
        $this->updatedAt = new \DateTime();

        return $this;
    }

    /**
     * Get role
     *
     * @return string
     */
    public function getRole(): string {
        return $this->role;
    }

    /**
     * Set role
     *
     * @param string $role
     *
     * @return User
     */
    public function setRole($role): self {
        $this->role = $role;

        return $this;
    }

    /**
     * Get localisations
     *
     * @return Localisation
     */
    public function getLocalisations(): Localisation {
        return $this->localisations;
    }

    /**
     * Set localisations
     *
     * @param Localisation|null $localisations
     * @return User
     *
     */
    public function setLocalisations(Localisation $localisations = null): self {
        $this->localisations = $localisations;

        return $this;
    }

    /**
     * Get permis
     *
     * @return Permis
     */
    public function getPermis(): Permis {
        return $this->permis;
    }

    /**
     * Set permis
     *
     * @param Permis $permis
     *
     * @return User
     */
    public function setPermis(Permis $permis = null): self {
        $this->permis = $permis;

        return $this;
    }

    /**
     * Add trajet
     *
     * @param Trajet $trajet
     * @return User
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
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTrajets(): Collection {
        return $this->trajets;
    }

    /**
     * Add vehicule
     *
     * @param Vehicule $vehicule
     * @return User
     *
     */
    public function addVehicule(Vehicule $vehicule): self {
        $this->vehicules[] = $vehicule;

        return $this;
    }

    /**
     * Remove vehicule
     *
     * @param Vehicule $vehicule
     */
    public function removeVehicule(Vehicule $vehicule) {
        $this->vehicules->removeElement($vehicule);
    }

    /**
     * Get vehicules
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getVehicules(): Collection {
        return $this->vehicules;
    }
}

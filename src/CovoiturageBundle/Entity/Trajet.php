<?php

namespace CovoiturageBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use UserBundle\Entity\User;

/**
 * Trajet
 *
 * @ORM\Table(name="trajets", indexes={@ORM\Index(name="fk_trajets_users1_idx", columns={"user_conducteur_id"})})
 * @ORM\Entity
 */
class Trajet {
    /**
     * @var integer
     *
     * @ORM\Column(name="nb_place_restante", type="integer", nullable=true)
     */
    private $nbPlaceRestante;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_conducteur_id", referencedColumnName="id")
     * })
     */
    private $userConducteur;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="CovoiturageBundle\Entity\Localisation", inversedBy="trajets")
     * @ORM\JoinTable(name="trajets_localisations",
     *   joinColumns={
     *     @ORM\JoinColumn(name="trajets_id", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="localisations_id", referencedColumnName="id")
     *   }
     * )
     */
    private $localisations;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="UserBundle\Entity\User", inversedBy="trajets")
     * @ORM\JoinTable(name="trajets_users",
     *   joinColumns={
     *     @ORM\JoinColumn(name="trajets_id", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="users_id", referencedColumnName="id")
     *   }
     * )
     */
    private $users;

    /**
     * Constructor
     */
    public function __construct() {
        $this->localisations = new ArrayCollection();
        $this->users = new ArrayCollection();
    }

    /**
     * Get nbPlaceRestante
     *
     * @return integer
     */
    public function getNbPlaceRestante() {
        return $this->nbPlaceRestante;
    }

    /**
     * Set nbPlaceRestante
     *
     * @param integer $nbPlaceRestante
     *
     * @return Trajet
     */
    public function setNbPlaceRestante($nbPlaceRestante) {
        $this->nbPlaceRestante = $nbPlaceRestante;

        return $this;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Get userConducteur
     *
     * @return User
     */
    public function getUserConducteur() {
        return $this->userConducteur;
    }

    /**
     * Set userConducteur
     *
     * @param User|null $userConducteur
     * @return Trajet
     */
    public function setUserConducteur(User $userConducteur = null) {
        $this->userConducteur = $userConducteur;

        return $this;
    }

    /**
     * Add localisation
     *
     * @param \CovoiturageBundle\Entity\Localisation $localisation
     * @return Trajet
     */
    public function addLocalisation(Localisation $localisation) {
        $this->localisations[] = $localisation;

        return $this;
    }

    /**
     * Remove localisation
     *
     * @param Localisation $localisation
     */
    public function removeLocalisation(Localisation $localisation) {
        $this->localisations->removeElement($localisation);
    }

    /**
     * Get localisations
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getLocalisations() {
        return $this->localisations;
    }

    /**
     * Add user
     *
     * @param User $user
     *
     * @return Trajet
     */
    public function addUser(User $user) {
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
    public function getUsers() {
        return $this->users;
    }
}

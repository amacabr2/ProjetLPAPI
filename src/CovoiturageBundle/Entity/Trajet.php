<?php

namespace CovoiturageBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
use UserBundle\Entity\User;

/**
 * Trajet
 *
 * @ORM\Table(name="trajets")
 * @ORM\Entity(repositoryClass="CovoiturageBundle\Repository\TrajetRepository")
 */
class Trajet {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     *
     * @Serializer\Groups({"trajet_list"})
     * @Serializer\Expose()
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="nb_place_restante", type="integer", nullable=true)
     *
     * @Serializer\Groups({"trajet_list", "trajet_detail"})
     */
    private $nbPlaceRestante;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_demandeur_id", referencedColumnName="id")
     * })
     *
     * @Serializer\Groups({"trajet_list", "trajet_detail"})
     */
    private $userDemandeur;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_conducteur_id", referencedColumnName="id")
     * })
     *
     * @Serializer\Groups({"trajet_detail"})
     */
    private $userConducteur;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="CovoiturageBundle\Entity\Localisation", inversedBy="trajets", cascade={"persist"})
     * @ORM\JoinTable(name="trajets_localisations",
     *   joinColumns={
     *     @ORM\JoinColumn(name="trajets_id", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="localisations_id", referencedColumnName="id")
     *   }
     * )
     *
     * @Serializer\Groups({"trajet_list", "trajet_detail"})
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
     *
     * @Serializer\Groups({"trajet_detail"})
     */
    private $users;

    /**
     * @var Vehicule
     *
     * @ORM\ManyToOne(targetEntity="CovoiturageBundle\Entity\Vehicule")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="vehicule_id", referencedColumnName="id")
     * })
     *
     * @Serializer\Groups({"trajet_detail"})
     */
    private $vehicule;

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
    public function getNbPlaceRestante(): int {
        return $this->nbPlaceRestante;
    }

    /**
     * Set nbPlaceRestante
     *
     * @param integer $nbPlaceRestante
     *
     * @return Trajet
     */
    public function setNbPlaceRestante(int $nbPlaceRestante): self {
        $this->nbPlaceRestante = $nbPlaceRestante;

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
     * @return User
     */
    public function getUserDemandeur(): User {
        return $this->userDemandeur;
    }

    /**
     * @param User $userDemandeur
     * @return Trajet
     */
    public function setUserDemandeur(User $userDemandeur): self {
        $this->userDemandeur = $userDemandeur;

        return $this;
    }

    /**
     * Get userConducteur
     *
     * @return User
     */
    public function getUserConducteur(): User {
        return $this->userConducteur;
    }

    /**
     * Set userConducteur
     *
     * @param User $userConducteur
     * @return Trajet
     */
    public function setUserConducteur(User $userConducteur): self {
        $this->userConducteur = $userConducteur;

        return $this;
    }

    /**
     * Add localisation
     *
     * @param \CovoiturageBundle\Entity\Localisation $localisation
     * @return Trajet
     */
    public function addLocalisation(Localisation $localisation): self {
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
    public function getLocalisations(): Collection {
        return $this->localisations;
    }

    /**
     * Add user
     *
     * @param User $user
     *
     * @return Trajet
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

    /**
     * Get vehicule
     *
     * @return Vehicule
     */
    public function getVehicule() {
        return $this->vehicule;
    }

    /**
     * Set vehicule
     *
     * @param Vehicule $vehicule
     *
     * @return Trajet
     */
    public function setVehicule(Vehicule $vehicule = null) {
        $this->vehicule = $vehicule;

        return $this;
    }
}

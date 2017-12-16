<?php

namespace CovoiturageBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

/**
 * Assurance
 *
 * @ORM\Table(name="assurances")
 * @ORM\Entity
 */
class Assurance {

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
     * @ORM\Column(name="fichier", type="string", length=255, nullable=true)
     *
     * @Serializer\Groups({"assurance_always"})
     */
    private $fichier;

    /**
     * @var boolean
     *
     * @ORM\Column(name="valide", type="boolean", nullable=true)
     *
     * @Serializer\Groups({"assurance_always"})
     */
    private $valide;

    /**
     * @var string
     *
     * @ORM\Column(name="date_obtention", type="string", length=45, nullable=true)
     *
     * @Serializer\Groups({"assurance_always"})
     */
    private $dateObtention;

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
     * @return Assurance
     */
    public function setFichier($fichier): self {
        $this->fichier = $fichier;

        return $this;
    }

    /**
     * Get valide
     *
     * @return boolean
     */
    public function getValide(): bool {
        return $this->valide;
    }

    /**
     * Set valide
     *
     * @param boolean $valide
     *
     * @return Assurance
     */
    public function setValide($valide): self {
        $this->valide = $valide;

        return $this;
    }

    /**
     * Get dateObtention
     *
     * @return string
     */
    public function getDateObtention(): string {
        return $this->dateObtention;
    }

    /**
     * Set dateObtention
     *
     * @param string $dateObtention
     *
     * @return Assurance
     */
    public function setDateObtention($dateObtention): self {
        $this->dateObtention = $dateObtention;

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
}

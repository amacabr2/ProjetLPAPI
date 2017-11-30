<?php

namespace CovoiturageBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Permis
 *
 * @ORM\Table(name="permis")
 * @ORM\Entity
 */
class Permis {

    /**
     * @var string
     *
     * @ORM\Column(name="fichier", type="string", length=255, nullable=true)
     */
    private $fichier;

    /**
     * @var boolean
     *
     * @ORM\Column(name="valide", type="boolean", nullable=true)
     */
    private $valide;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_obtention", type="date", nullable=true)
     */
    private $dateObtention;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

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
     * @return Permis
     */
    public function setFichier(string $fichier): self {
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
     * @return Permis
     */
    public function setValide(bool $valide): self {
        $this->valide = $valide;

        return $this;
    }

    /**
     * Get dateObtention
     *
     * @return \DateTime
     */
    public function getDateObtention(): \DateTime {
        return $this->dateObtention;
    }

    /**
     * Set dateObtention
     *
     * @param \DateTime $dateObtention
     *
     * @return Permis
     */
    public function setDateObtention(\DateTime $dateObtention): self {
        $this->dateObtention = $dateObtention;

        return $this;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId(): self {
        return $this->id;
    }
}

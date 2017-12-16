<?php

namespace CovoiturageBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

/**
 * Energie
 *
 * @ORM\Table(name="energies")
 * @ORM\Entity
 */
class Energie {

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
     * @ORM\Column(name="libelle", type="string", length=45, nullable=true)
     *
     * @Serializer\Groups({"energie_always"})
     */
    private $libelle;

    /**
     * Get libelle
     *
     * @return string
     */
    public function getLibelle(): string {
        return $this->libelle;
    }

    /**
     * Set libelle
     *
     * @param string $libelle
     *
     * @return Energie
     */
    public function setLibelle(string $libelle): self {
        $this->libelle = $libelle;

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

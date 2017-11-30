<?php

namespace CovoiturageBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Etat
 *
 * @ORM\Table(name="etats")
 * @ORM\Entity
 */
class Etat {

    /**
     * @var string
     *
     * @ORM\Column(name="label", type="string", length=45, nullable=true)
     */
    private $label;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * Get label
     *
     * @return string
     */
    public function getLabel(): string {
        return $this->label;
    }

    /**
     * Set label
     *
     * @param string $label
     *
     * @return Etat
     */
    public function setLabel(string $label) {
        $this->label = $label;

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

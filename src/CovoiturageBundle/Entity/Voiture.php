<?php

namespace CovoiturageBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Voiture
 *
 * @ORM\Table(name="voitures")
 * @ORM\Entity
 */
class Voiture
{
    /**
     * @var integer
     *
     * @ORM\Column(name="coffre", type="integer", nullable=true)
     */
    private $coffre;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;



    /**
     * Set coffre
     *
     * @param integer $coffre
     *
     * @return Voiture
     */
    public function setCoffre($coffre)
    {
        $this->coffre = $coffre;

        return $this;
    }

    /**
     * Get coffre
     *
     * @return integer
     */
    public function getCoffre()
    {
        return $this->coffre;
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
}

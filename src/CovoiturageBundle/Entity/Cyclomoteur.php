<?php

namespace CovoiturageBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Cyclomoteur
 *
 * @ORM\Table(name="cyclomoteurs")
 * @ORM\Entity
 */
class Cyclomoteur
{
    /**
     * @var integer
     *
     * @ORM\Column(name="cylindre", type="integer", nullable=true)
     */
    private $cylindre;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;



    /**
     * Set cylindre
     *
     * @param integer $cylindre
     *
     * @return Cyclomoteur
     */
    public function setCylindre($cylindre)
    {
        $this->cylindre = $cylindre;

        return $this;
    }

    /**
     * Get cylindre
     *
     * @return integer
     */
    public function getCylindre()
    {
        return $this->cylindre;
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

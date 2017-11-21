<?php

namespace UserBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\AttributeOverride;
use Doctrine\ORM\Mapping\AttributeOverrides;
use Doctrine\ORM\Mapping\Column;

/**
 * User.
 *
 * @ORM\Table("users")
 * @ORM\Entity
 * @AttributeOverrides({
 *      @AttributeOverride(name="usernameCanonical",
 *          column=@Column(
 *              type     = "string",
 *              length   = 155,
 *          )
 *      ),
 *      @AttributeOverride(name="emailCanonical",
 *          column=@Column(
 *              type     = "string",
 *              length   = 155,
 *          )
 *      )
 * })
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
     * Get id
     *
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getPasswordResetToken(): ?string {
        return $this->passwordResetToken;
    }

    /**
     * @param string $passwordResetToken
     */
    public function setPasswordResetToken(?string $passwordResetToken) {
        $this->passwordResetToken = $passwordResetToken;
    }
}


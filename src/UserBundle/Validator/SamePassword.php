<?php
/**
 * Created by PhpStorm.
 * User: amacabr2
 * Date: 16/11/17
 * Time: 17:38
 */

namespace UserBundle\Validator;


use Symfony\Component\Validator\Constraint;

/**
 * Class SamePassword
 * @package UserBundle\Validator
 *
 * @Annotation
 */
class SamePassword extends Constraint {

    public $message = "Les deux mots de passe ne sont pas les mêmes";

}
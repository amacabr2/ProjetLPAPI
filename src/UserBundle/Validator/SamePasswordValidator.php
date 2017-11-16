<?php
/**
 * Created by PhpStorm.
 * User: amacabr2
 * Date: 16/11/17
 * Time: 17:40
 */

namespace UserBundle\Validator;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

class SamePasswordValidator extends ConstraintValidator {

    /**
     * @var array
     */
    private static $passwords = [];

    /**
     * Checks if the passed value is valid.
     *
     * @param mixed $value The value that should be validated
     * @param Constraint $constraint The constraint for the validation
     */
    public function validate($value, Constraint $constraint) {
        if (!$constraint instanceof SamePassword) {
            throw new UnexpectedTypeException($constraint, __NAMESPACE__.'\SamePassword');
        }

        self::$passwords[] = $value;
        if (sizeof(self::$passwords) == 2) {
            $same =  self::$passwords[0] == self::$passwords[1];
            self::$passwords = [];
            if (!$same) {
                $this->context->buildViolation($constraint->message)
                    ->setParameter('{{ value }}', $this->formatValue($value))
                    ->addViolation();
            }
        }
    }
}
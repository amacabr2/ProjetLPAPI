<?php
/**
 * Created by PhpStorm.
 * User: antho
 * Date: 13/12/2017
 * Time: 13:10
 */

namespace UserBundle\Form;

use CovoiturageBundle\Form\LocalisationType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class RegistrationType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add("prenom")
            ->add("nom")
            ->add("civilite")
            ->add("dateNaissance")
            ->add("telFixe")
            ->add("telPortable")
            ->add("fichier")
            ->add("newsletter")
            ->add("presentation")
            ->add("formation", FormationType::class)
            ->add("localisation", LocalisationType::class)
        ;
    }

    public function getParent() {
        return 'FOS\UserBundle\Form\Type\RegistrationFormType';
    }

    public function getBlockPrefix() {
        return 'user_registration';
    }
}
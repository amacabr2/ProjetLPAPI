<?php

namespace CovoiturageBundle\Controller;


use CovoiturageBundle\Entity\Vehicule;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use UserBundle\Entity\User;

class VehiculeController extends Controller {

    /**
     * Liste le(s) véhicule(s) de l'utilisateur
     *
     * @Rest\Get(path="/users/{user}/vehicules", name="covoiturage_vehicules_user")
     * @Rest\View(serializerGroups={"vehicule_always"})
     *
     * @param User $user
     * @return Vehicule[]
     */
    public function indexByUserAction(User $user) {
        return $this->getDoctrine()->getRepository("CovoiturageBundle:Vehicule")->findAllByUser($user->getId());
    }


}

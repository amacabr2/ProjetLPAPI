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

    /**
     * Détails sur le véhicule voulu
     *
     * @Rest\Get(path="/vehicules/{id}", name="covoiturage_vehicules_show")
     * @Rest\View(serializerGroups={"vehicule_always", "assurance_always", "energie_always", "etat_always"})
     *
     * @param Vehicule $vehicule
     * @return Vehicule
     */
    public function showAction(Vehicule $vehicule) {
        return $vehicule;
    }


}

<?php

namespace CovoiturageBundle\Controller;


use CovoiturageBundle\Entity\Vehicule;
use FOS\RestBundle\Controller\Annotations as Rest;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use UserBundle\Entity\User;
use Symfony\Component\HttpFoundation\Response;

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

    /**
     * Ajoute un véhicule à l'utilisateur
     *
     * @Rest\Post(path="/users/{user}/vehicules")
     * @Rest\View(statusCode=Response::HTTP_CREATED)
     * @ParamConverter("vehicule", converter="fos_rest.request_body")
     *
     * @param Vehicule $vehicule
     * @param User $user
     * @return Vehicule
     */
    public function addAction(Vehicule $vehicule, User $user) {
        //TODO : relation avec assurance : ManyToOne ou OneToOne ?
        $user->addVehicule($vehicule);

        $em = $this->getDoctrine()->getManager();
        $em->persist($user);
        $em->flush();

        return $vehicule;
    }
}

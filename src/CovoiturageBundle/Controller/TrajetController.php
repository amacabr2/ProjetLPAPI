<?php

namespace CovoiturageBundle\Controller;

use CovoiturageBundle\Entity\Trajet;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class TrajetController extends Controller {

    /**
     * @Rest\Get(path="/trajets", name="covoiturage_trajets_index")
     * @Rest\View(serializerGroups={"trajet_list", "user_trajet", "localisation_always", "vehicule_always", "energie_always", "assurance_always", "etat_always"})
     *
     * @return Trajet[]
     */
    public function indexAction() {
        return $this->getDoctrine()->getRepository('CovoiturageBundle:Trajet')->findAll();
    }

    /**
     * @Rest\Get(path="/trajets/{id}", name="covoiturage_trajets_show")
     * @Rest\View(serializerGroups={"trajet_detail", "user_trajet", "localisation_always",  "vehicule_always", "energie_always", "assurance_always", "etat_always"})
     *
     * @param Trajet $trajet
     * @return Trajet
     */
    public function showAction(Trajet $trajet) {
        return $trajet;
    }

    /**
     * @Rest\Post(path="/trajets", name="covoiturage_trajets_create")
     * @Rest\View(statusCode=Response::HTTP_CREATED)
     *
     * @param Trajet $trajet
     * @return Trajet
     */
    public function addAction(Trajet $trajet) {
        $em = $this->getDoctrine()->getManager();
        $em->persist($trajet);
        $em->flush();

        return $trajet;
    }

    /**
     * @Rest\Put(path="/trajets/{id}")
     */
    public function updateAction() {

    }

    /**
     * @Rest\Delete(path="/trajets/{id}")
     */
    public function deleteAction() {

    }
}

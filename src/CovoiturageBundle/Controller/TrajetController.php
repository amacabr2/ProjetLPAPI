<?php

namespace CovoiturageBundle\Controller;

use CovoiturageBundle\Entity\Trajet;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class TrajetController extends Controller {

    /**
     * @Rest\Get(path="/trajets", name="covoiturage_trajets_index")
     * @Rest\View(serializerGroups={"trajet_list", "user_trajet"})
     *
     * @return Trajet[]
     */
    public function indexAction() {
        return $this->getDoctrine()->getRepository('CovoiturageBundle:Trajet')->findAll();
    }

    /**
     * @param Trajet $trajet
     *
     * @Rest\Get(path="/trajets/{id}", name="covoiturage_trajets_show")
     * @Rest\View(serializerGroups={"trajet_detail", "user_trajet"})
     *
     * @return Trajet
     */
    public function showAction(Trajet $trajet) {
        return $trajet;
    }
}

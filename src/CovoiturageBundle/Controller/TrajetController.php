<?php

namespace CovoiturageBundle\Controller;

use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class TrajetController extends Controller {

    /**
     * @Rest\Get(path="/trajets", name="covoiturage_trajets_index")
     * @Rest\View(serializerGroups={"trajet_detail", "user_trajet"})
     */
    public function indexAction() {
        return $this->getDoctrine()->getRepository('CovoiturageBundle:Trajet')->findAll();
    }
}

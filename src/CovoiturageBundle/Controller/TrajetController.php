<?php

namespace CovoiturageBundle\Controller;

use CovoiturageBundle\Entity\Trajet;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class TrajetController extends Controller {

    /**
     * @Rest\Get("/trajets", name="covoiturage_trajets_show")
     * @return Trajet[]
     */
    public function indexAction(): array {
        return $this->getDoctrine()->getRepository('CovoiturageBundle:Trajet')->findAll();
    }
}

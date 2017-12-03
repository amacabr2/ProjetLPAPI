<?php

namespace CovoiturageBundle\Controller;

use CovoiturageBundle\Entity\Etat;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class EtatController extends Controller {

    /**
     * @Rest\Get(path="/etats", name="covoiturage_etats_index")
     * @Rest\View()
     *
     * @return array|Etat[]
     */
    public function indexAction() {
        return $this->getDoctrine()->getRepository('CovoiturageBundle:Etat')->findAll();
    }
}

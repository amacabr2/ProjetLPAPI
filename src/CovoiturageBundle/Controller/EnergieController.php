<?php

namespace CovoiturageBundle\Controller;

use CovoiturageBundle\Entity\Energie;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class EnergieController extends Controller {

    /**
     * @Rest\Get(path="/energies", name="covoiturage_energies_index")
     * @Rest\View()
     *
     * @return Energie[]
     */
    public function indexAction() {
        return $this->getDoctrine()->getRepository('CovoiturageBundle:Energie')->findAll();
    }
}

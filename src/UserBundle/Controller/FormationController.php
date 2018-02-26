<?php
/**
 * Created by PhpStorm.
 * User: antho
 * Date: 26/02/2018
 * Time: 12:15
 */

namespace UserBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use UserBundle\Helper\ControllerHelper;

class FormationController extends Controller{

    use ControllerHelper;

    /**
     * @Rest\Get(path="/formations", name="users_index")
     * @Rest\View()
     *
     * @param Request $request
     * @return array|\CovoiturageBundle\Entity\Etat[]|\CovoiturageBundle\Entity\Localisation[]|\CovoiturageBundle\Entity\Permis[]|\CovoiturageBundle\Entity\Vehicule[]|\UserBundle\Entity\Formation[]
     */
    public function indexAction(Request $request) {
        return $this->getDoctrine()->getRepository('UserBundle:Formation')->findAll();
    }
}
<?php

namespace CovoiturageBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class NeutralController extends Controller {

    /**
     * @Route("/how-are-you", name="covoiturage_neutral")
     * @Method("GET")
     * @param Request $request
     * @return Response
     */
    public function neutralAction(Request $request): Response {
        $this->addFlash('success', 'Votre mot de passe a été modifié avec succés');
        return $this->render('@Covoiturage/Default/index.html.twig');
    }
}

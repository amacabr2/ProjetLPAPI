<?php

namespace CovoiturageBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use UserBundle\Helper\ControllerHelper;

/**
 * @Security("is_granted('ROLE_USER')")
 */
class AccueilController extends Controller {

    use ControllerHelper;

    /**
     * @Route("/accueil", name="user_welcome")
     * @Method("GET")
     * @param Request $request
     * @return Response
     */
    public function accueilAction(Request $request): Response {
        $response = new Response($this->serialize('Hello user.'), Response::HTTP_OK);
        return $this->setBaseHeaders($response);
    }
}

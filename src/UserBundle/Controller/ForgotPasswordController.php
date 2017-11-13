<?php

namespace UserBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use UserBundle\Form\ForgotPasswordType;

class ForgotPasswordController extends Controller {

    /**
     * @Route("/resetting", name="users_resetting_send_email")
     * @Method("POST")
     * @param Request $request
     * @return Response
     */
    public function sendEmailPassword(Request $request): Response {
        $data = json_decode($request->getContent());
        $user = $this->getDoctrine()
            ->getRepository('UserBundle:User')
            ->findOneBy(['email' => $data->email]);

        if (!$user) {
            throw $this->createNotFoundException();
        }

        $this->get('forgot_password_email')->sendForgotPasswordMessage($user);

        return new Response($data->email);
    }

    /**
     * @Route("/change-password", name="users_resetting_password")
     * @Method({"GET", "POST"})
     * @param Request $request
     * @return Response
     */
    public function changePasswordAction(Request $request): Response {
        if ($request->getMethod() == "POST") {
            return new Response();
        }

        $form = $this->get('form.factory')->create(ForgotPasswordType::class, null);

        return $this->render("UserBundle:form:change_password.html.twig", [
            'form' => $form->createView()
        ]);
    }
}

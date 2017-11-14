<?php

namespace UserBundle\Controller;

use FOS\RestBundle\Controller\Annotations as Rest;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use UserBundle\Form\ForgotPasswordType;
use UserBundle\Utils\RandomTokenGenerator;

class ForgotPasswordController extends Controller {

    /**
     * @Route("/resetting", name="users_resetting_send_email")
     * @Method("POST")
     * @param Request $request
     * @return Response
     */
    public function sendEmailPassword(Request $request): Response {
        $data = json_decode($request->getContent());
        $em = $this->getDoctrine()->getManager();
        $user = $this->getDoctrine()
            ->getRepository('UserBundle:User')
            ->findOneBy(['email' => $data->email]);

        if (!$user) {
            throw $this->createNotFoundException();
        }

        $generator = new RandomTokenGenerator();
        $token = $generator->generate(48);

        $user->setPasswordResetToken($token);
        $em->persist($user);
        $em->flush();

        $this->get('forgot_password_email')->sendForgotPasswordMessage($user, $token);

        return new Response($user->getEmail());
    }

    /**
     * @Route("/change-password/", name="users_resetting_password")
     * @Method("GET")
     * @param Request $request
     * @return Response
     */
    public function changePasswordAction(Request $request): Response {
        $form = $this->get('form.factory')->create(ForgotPasswordType::class, [
            'token_resetting' => $request->query->get('token_resetting')
        ]);

        return $this->render("UserBundle:form:change_password.html.twig", [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/update-password")
     * @Method("POST")
     * @param Request $request
     */
    public function upadatePasswordAction(Request $request){

    }
}

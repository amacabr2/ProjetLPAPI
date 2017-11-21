<?php

namespace UserBundle\Controller;

use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\UserBundle\Event\FilterUserResponseEvent;
use FOS\UserBundle\Event\FormEvent;
use FOS\UserBundle\Event\GetResponseUserEvent;
use FOS\UserBundle\FOSUserEvents;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
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

        $token = $this->get('token_change_password')->generate(48);

        $user->setPasswordResetToken($token);
        $em->persist($user);
        $em->flush();

        $this->get('forgot_password_email')->sendForgotPasswordMessage($user, $token);

        return new Response($user->getEmail());
    }

    /**
     * @Route("/change-password/{id}/{token_resetting}", name="users_resetting_password")
     * @Method({"GET", "POST"})
     * @param Request $request
     * @param int $id
     * @param string $token_resetting
     * @return Response
     * @throws \Exception
     */
    public function changePasswordAction(Request $request, int $id, string $token_resetting): Response {
        $form = $this->get('form.factory')->create(ForgotPasswordType::class, [
            'id' => $id,
            'token_resetting' => $token_resetting
        ]);
        $dispatcher = $this->get('event_dispatcher');
        $userManager = $this->container->get('fos_user.user_manager');

        if ($request->isMethod("POST")) {
            $form->handleRequest($request);

            if ($form->isSubmitted() and $form->isValid()) {
                $data = $form->getData();
                $user = $this->getDoctrine()
                    ->getRepository('UserBundle:User')
                    ->findOneBy(['id' => $data['id']]);
                $event = new GetResponseUserEvent($user, $request);
                $dispatcher->dispatch(FOSUserEvents::CHANGE_PASSWORD_INITIALIZE, $event);

                if (null != $event->getResponse()) {
                    return $event->getResponse();
                }

                if (!$user) {
                    throw $this->createNotFoundException('Unable to find User entity.');
                }

                if ($user->getPasswordResetToken() != $token_resetting) {
                    $this->addFlash('info', 'Vous avez déjà changer votre mot de passe');
                    return $this->redirectToRoute('covoiturage_neutral');
                }

                $event = new FormEvent($form, $request);
                $dispatcher->dispatch(FOSUserEvents::CHANGE_PASSWORD_SUCCESS, $event);
                $user->setPlainPassword($data['password']);
                $user->setPasswordResetToken(null);
                $userManager->updateUser($user);

                if (null === $event->getResponse()) {
//                    $url = $this->generateUrl('covoiturage_neutral');
//                    $response = new RedirectResponse($url);
//                    $dispatcher->dispatch(FOSUserEvents::CHANGE_PASSWORD_COMPLETED, new FilterUserResponseEvent($user, $request, $response));
                    $this->addFlash('success', 'Votre mot de passe a été modifié avec succés');
                    return $this->redirectToRoute('covoiturage_neutral');
                }
            }

        }

        return $this->render("UserBundle:form:change_password.html.twig", [
            'form' => $form->createView()
        ]);
    }
}

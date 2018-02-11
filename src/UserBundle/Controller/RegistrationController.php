<?php

namespace UserBundle\Controller;

use CovoiturageBundle\Entity\Localisation;
use FOS\UserBundle\Controller\RegistrationController as BaseController;
use FOS\UserBundle\Form\Factory\FactoryInterface;
use FOS\UserBundle\Model\UserManagerInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use FOS\UserBundle\Event\GetResponseUserEvent;
use FOS\UserBundle\Event\FormEvent;
use FOS\UserBundle\FOSUserEvents;
use Symfony\Component\Form\FormInterface;
use UserBundle\Entity\User;
use UserBundle\Exception\BadRegistrationException;
use UserBundle\Helper\ControllerHelper;

class RegistrationController extends BaseController {

    use ControllerHelper;

    /**
     * @Route("/register", name="user_register")
     * @Method("POST")
     * @param Request $request
     * @return Response
     * @throws BadRegistrationException
     */
    public function registerAction(Request $request): Response {
        /** @var FactoryInterface */
        $formFactory = $this->get('fos_user.registration.form.factory');
        /** @var UserManagerInterface */
        $userManager = $this->get('fos_user.user_manager');
        /** @var EventDispatcherInterface */
        $dispatcher = $this->get('event_dispatcher');

        /** @var User $userRequest */
        $userRequest = $request->request->all();
        $errors = $this->get('validator')->validate($userRequest);
        if (count($errors)) {
            throw new BadRegistrationException($this->serialize($errors));
        }

        /** @var User $user */
        $user = $userManager->createUser();
        $event = new GetResponseUserEvent($user, $request);
        $dispatcher->dispatch(FOSUserEvents::REGISTRATION_INITIALIZE, $event);

        if (null !== $event->getResponse()) {
            return $event->getResponse();
        }

        $user = $this->buildUser($user, $request);

        $form = $formFactory->createForm(['csrf_protection' => false]);
        $form->setData($user);
        $this->processForm($request, $form);

        if ($form->isValid()) {
            $event = new FormEvent($form, $request);
            $dispatcher->dispatch(FOSUserEvents::REGISTRATION_SUCCESS, $event);
            $userManager->updateUser($user);
            $response = new Response($this->serialize(['message' => 'Votre compte a été crée.']), Response::HTTP_CREATED);
        } else {
            return $this->throwApiProblemValidationException($form);
        }

        /** @var Response $response */
        return $this->setBaseHeaders($response);
    }

    /**
     * @param User $user
     * @param Request $request
     * @return User
     */
    private function buildUser(User $user, Request $request): User {
        $user->setPrenom($request->get("prenom"));
        $user->setNom($request->get("nom"));
        $user->setCivilite($request->get("civilite"));
        $user->setDateNaissance($request->get("dateNaissance"));
        $user->setTelFixe($request->get("telFixe"));
        $user->setTelPortable($request->get("telPortable"));
        $user->setFichier($request->get("fichier"));
        $user->setNewsletter($request->get("newsletter"));
        $user->setPresentation($request->get("presentation"));
        $user->setLocalisation($this->buildLocalisation($request));
        $user->setCreatedAt();

        return $user;
    }

    /**
     * @param Request $request
     * @return Localisation
     */
    private function buildLocalisation(Request $request): Localisation {
        $localisation = new Localisation();
        $loc = $request->get("localisation");
        $localisation->setAdresse($loc["adresse"]);
        $localisation->setVille($loc["ville"]);
        $localisation->setCodePostal($loc["codePostal"]);
        return $localisation;
    }

    /**
     * @param FormInterface $form
     * @throws BadRegistrationException
     */
    private function throwApiProblemValidationException(FormInterface $form) {
        throw new BadRegistrationException(
            $this->serialize($this->getErrorsFromForm($form))
        );
    }
}

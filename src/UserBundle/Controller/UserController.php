<?php

namespace UserBundle\Controller;

use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\UserBundle\Event\FormEvent;
use FOS\UserBundle\Event\GetResponseUserEvent;
use FOS\UserBundle\Form\Factory\FactoryInterface;
use FOS\UserBundle\FOSUserEvents;
use FOS\UserBundle\Model\UserManagerInterface;
use JMS\Serializer\EventDispatcher\EventDispatcherInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use UserBundle\Entity\User;
use Symfony\Component\HttpFoundation\Response;
use UserBundle\Exception\BadRegistrationException;
use UserBundle\Helper\ControllerHelper;

class UserController extends Controller {

    use ControllerHelper;

    /**
     * @Rest\Get(path="/users", name="users_users")
     * @Rest\View(serializerGroups={"user_list"})
     *
     * @return array|\CovoiturageBundle\Entity\Localisation[]|\CovoiturageBundle\Entity\Trajet[]|User[]
     */
    public function getUsersAction() {
        return $this->getDoctrine()->getRepository('UserBundle:User')->findAll();
    }

    /**
     * @Rest\Get(path="/users/{id}", name="users_user")
     * @Rest\View(serializerGroups={"user_detail", "user_trajet", "trajet_list", "localisation_always", "vehicule_always", "etat_always", "energie_always", "assurance_always"})
     *
     * @param User $user
     * @return User
     */
    public function getUserAction(User $user) {
        return $user;
    }

    /**
     * @Resst\Put(path="/users/{user}", name="users_update")
     *
     * @param Request $request
     * @param User $user
     * @return Response
     * @throws BadEditUserException
     */
    public function updateUser(Request $request, User $user) {
        /** @var FactoryInterface */
        $formFactory = $this->get('fos_user.profile.form.factory');
        /** @var UserManagerInterface */
        $userManager = $this->get('fos_user.user_manager');
        /** @var EventDispatcherInterface */
        $dispatcher = $this->get('event_dispatcher');

        /** @var User $userRequest */
        $userRequest = $request->request->all();
        $errors = $this->get('validator')->validate($userRequest);
        if (count($errors)) {
            throw new BadEditUserException($this->serialize($errors));
        }

        $event = new GetResponseUserEvent($user, $request);
        $dispatcher->dispatch(FOSUserEvents::PROFILE_EDIT_INITIALIZE);

        if ($event->getResponse() !== null) {
            return $event->getResponse();
        }

        $form = $formFactory->createForm(['csrf_protection' => false]);
        $form->setData($user);
        $this->processForm($request, $form);

        if ($form->isValid()) {
            $event = new FormEvent($form, $request);
            $dispatcher->dispatch(FOSUserEvents::PROFILE_EDIT_SUCCESS, $event);
            $userManager->updateUser($user);
            $response = new Response($this->serialize(['message' => 'Votre compte a été modifié']));
        } else {
            throw $this->throwApiProblemValidationException($form);
        }

        return $this->setBaseHeaders($response);
    }

    /**
     * @param FormInterface $form
     * @throws BadEditUserException
     */
    private function throwApiProblemValidationException(FormInterface $form) {
        throw new BadEditUserException(
            $this->serialize($this->getErrorsFromForm($form))
        );
    }
}

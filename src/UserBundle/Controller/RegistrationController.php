<?php

namespace UserBundle\Controller;

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
use UserBundle\Helper\ControllerHelper;

class RegistrationController extends BaseController {

    use ControllerHelper;

    /**
     * @Route("/register", name="user_register")
     * @Method("POST")
     * @param Request $request
     * @return Response
     */
    public function registerAction(Request $request): Response {
        /** @var FactoryInterface */
        $formFactory = $this->get('fos_user.registration.form.factory');
        /** @var UserManagerInterface */
        $userManager = $this->get('fos_user.user_manager');
        /** @var EventDispatcherInterface */
        $dispatcher = $this->get('event_dispatcher');

        $user = $userManager->createUser();
        $event = new GetResponseUserEvent($user, $request);
        $dispatcher->dispatch(FOSUserEvents::REGISTRATION_INITIALIZE, $event);

        if (null !== $event->getResponse()) {
            return $event->getResponse();
        }

        $form = $formFactory->createForm(['csrf_protection' => false]);
        $form->setData($user);
        $this->processForm($request, $form);

        if ($form->isValid()) {
            $event = new FormEvent($form, $request);
            $dispatcher->dispatch(FOSUserEvents::REGISTRATION_SUCCESS, $event);
            $userManager->updateUser($user);
            $response = new Response($this->serialize('User created.'), Response::HTTP_CREATED);
        } else {
            throw $this->throwApiProblemValidationException($form);
        }

        /** @var Response $response */
        return $this->setBaseHeaders($response);
    }

    /**
     * @param  Request $request
     * @param  FormInterface $form
     * @throws BadRequestHttpException
     */
    private function processForm(Request $request, FormInterface $form) {
        $data = json_decode($request->getContent(), true);
        if ($data === null) {
            throw new BadRequestHttpException();
        }
        $form->submit($data);
    }

    /**
     * @param FormInterface $form
     * @throws BadRequestHttpException
     */
    private function throwApiProblemValidationException(FormInterface $form) {
        throw new BadRequestHttpException(
            $this->serialize($this->getErrorsFromForm($form))
        );
    }

    /**
     * @param FormInterface $form
     * @return array
     */
    private function getErrorsFromForm(FormInterface $form): array {
        $errors = [];

        foreach ($form->getErrors() as $key => $error) {
            $template = $error->getMessageTemplate();
            $parameters = $error->getMessageParameters();

            foreach ($parameters as $var => $value) {
                $template = str_replace($var, $value, $template);
            }
            $errors[$key] = $template;
        }

        foreach ($form->all() as $childform) {
            if ($childform instanceof FormInterface) {
                if ($childErrors = $this->getErrorsFromForm($childform)) {
                    $errors[$childform->getName()] = $childErrors;
                }
            }
        }

        return $errors;
    }
}

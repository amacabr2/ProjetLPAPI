<?php

namespace UserBundle\Controller;

use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use UserBundle\Entity\User;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller {

    /**
     * @Rest\Get(path="/users", name="user_users")
     * @Rest\View(statusCode=Response::HTTP_OK)
     *
     * @return array|\CovoiturageBundle\Entity\Localisation[]|\CovoiturageBundle\Entity\Trajet[]|User[]
     */
    public function getUsersAction() {
        return $this->getDoctrine()->getRepository('UserBundle:User')->findAll();
    }

    /**
     * @Rest\Get(path="/users/{id}", name="user_user")
     * @Rest\View(statusCode=Response::HTTP_OK)
     *
     * @param User $user
     * @return User
     */
    public function getUserAction(User $user) {
        return $user;
    }
}

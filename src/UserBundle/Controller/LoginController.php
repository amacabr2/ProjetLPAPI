<?php

namespace UserBundle\Controller;

use UserBundle\Exception\BadAuthenticationLoginException;
use UserBundle\Exception\BadAuthenticationPasswordException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use UserBundle\Entity\User;
use UserBundle\Helper\ControllerHelper;

class LoginController extends Controller {

    use ControllerHelper;

    /**
     * @Route("/login", name="user_login")
     * @Method("POST")
     * @param Request $request
     * @return Response
     * @throws BadAuthenticationPasswordException
     * @throws BadAuthenticationLoginException
     * @throws \Lexik\Bundle\JWTAuthenticationBundle\Exception\JWTEncodeFailureException
     */
    public function loginAction(Request $request): Response {
        $data = json_decode($request->getContent());
        $username = $data->username;
        $password = $data->password;

        $user = $this->getDoctrine()
            ->getRepository('UserBundle:User')
            ->findOneBy(['username' => $username]);

        if (!$user) {
            throw new BadAuthenticationLoginException("Login invalide");
        }

        if (!$this->get('security.password_encoder')->isPasswordValid($user, $password)) {
            throw new BadAuthenticationPasswordException("Mot de passe invalide");
        }

        return $this->setBaseHeaders(new Response(
            $this->serialize([
                'user_id' => $user->getId(),
                'token' => $this->getToken($user)
            ]),
            Response::HTTP_OK
        ));
    }

    /**
     * @param User $user
     * @return string
     * @throws \Lexik\Bundle\JWTAuthenticationBundle\Exception\JWTEncodeFailureException
     */
    private function getToken(User $user): string {
        return $this->container->get('lexik_jwt_authentication.encoder')
            ->encode([
                'username' => $user->getUsername(),
                'exp' => $this->getTokenExpiryDateTime()
            ]);
    }

    /**
     * @return string
     */
    private function getTokenExpiryDateTime(): string {
        $tokenTtl = $this->container->getParameter('lexik_jwt_authentication.token_ttl');
        $now = new \DateTime();
        $now->add(new \DateInterval('PT' . $tokenTtl . 'S'));
        return $now->format('U');
    }
}

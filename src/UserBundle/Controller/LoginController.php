<?php

namespace UserBundle\Controller;

use GuzzleHttp\Psr7\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Exception\BadCredentialsException;
use UserBundle\Entity\User;
use UserBundle\Helper\ControllerHelper;

class LoginController extends Controller {

    use ControllerHelper;

    /**
     * @Route("/login", name="user_login")
     * @Method("POST")
     * @param Request $request
     * @return Response
     */
    public function loginAction(Request $request): Response {
        $username = $request->getUser();
        $password = $request->getPassword();

        $user = $this->getDoctrine()
            ->getRepository('UserBundle:User')
            ->findOneBy(['username' => $username]);

        if (!$user) {
            $this->createNotFoundException();
        }

        $isValid = $this->get('security.password_encoder')->isPasswordValid($user, $password);
        if (!$isValid) {
            throw new BadCredentialsException();
        }

        return $this->setBaseHeaders(new Response(
            $this->serialize(['token',  $this->getToken($user)]),
            Response::HTTP_OK
        ));
    }

    /**
     * @param User $user
     * @return array
     */
    private function getToken(User $user): array {
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

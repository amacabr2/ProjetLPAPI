<?php
/**
 * Created by PhpStorm.
 * User: amacabr2
 * Date: 05/11/17
 * Time: 11:18
 */

namespace Tests\UserBundle\Controller;


use Symfony\Component\Security\Core\Exception\BadCredentialsException;
use Tests\ApiTestCaseBase;

class LoginControllerTest extends ApiTestCaseBase {

    private $username = "amacabr2";

    private $password = "test123";

    public function testPOSTLoginUser() {
        $user = $this->createUser($this->username, $this->password);

        $this->client->request('POST', '/users/login', [], [], [
            'CONTENT_TYPE' => 'application/json',
        ], json_encode([
            'username' => $user->getUsername(),
            'password'=> $user->getPassword()
        ]));

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());

        $responseArr = json_decode($this->client->getResponse()->getContent(), true);
        $this->assertArrayHasKey('token', $responseArr);
    }

    public function testPOSTLoginUserWithWrongUsername() {
        $user = $this->createUser($this->username, $this->password);

        $this->client->request('POST', '/users/login', [], [], [
                'CONTENT_TYPE' => 'application/json',
            ], json_encode([
                'username' => $user->getUsername() . 'bad_username',
                'password'=> $user->getPassword()
            ])
        );

        $this->assertEquals(404, $this->client->getResponse()->getStatusCode());
        $responseArr = json_decode($this->client->getResponse()->getContent(), true);
        $this->assertEquals('Not Found', $responseArr['error']['message']);
    }

    public function testPOSTLoginUserWithWrongPassword() {
        $user = $this->createUser($this->username, $this->password);

        $this->client->request('POST', '/users/login', [], [], [
                'CONTENT_TYPE' => 'application/json',
            ], json_encode([
                'username' => $user->getUsername(),
                'password'=> $user->getPassword() . 'bad_password'
            ])
        );

        $this->assertEquals(400, $this->client->getResponse()->getStatusCode());
        $responseArr = json_decode($this->client->getResponse()->getContent(), true);
        $this->assertEquals('Bad Request', $responseArr['error']['message']);
    }
}
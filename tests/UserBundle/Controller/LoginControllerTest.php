<?php
/**
 * Created by PhpStorm.
 * User: amacabr2
 * Date: 05/11/17
 * Time: 11:18
 */

namespace Tests\UserBundle\Controller;


use Tests\ApiTestCaseBase;

class LoginControllerTest extends ApiTestCaseBase {

    public function testPOSTLoginUser() {
        $user = $this->createUser("amacabr2", "test123");

        $this->client->request('POST', '/users/login', [], [], [
            'CONTENT_TYPE' => 'application/json',
            'PHP_AUTH_USER' => $user->getUsername(),
            'PHP_AUTH_PW'   => $user->getPassword(),
        ]);

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());

        $responseArr = json_decode($this->client->getResponse()->getContent(), true);
        $this->assertArrayHasKey('token', $responseArr);
    }
}
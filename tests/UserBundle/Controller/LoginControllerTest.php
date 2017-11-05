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
        $username = "amacabr2";
        $password = "azerty";
        $user = $this->createUser($username, $password);

        $this->client->request('POST', 'users/login', [], [], [
            'CONTENT_TYPE' => 'application/json',
            'PHP_AUTH_USER' => $username,
            'PHP_AUTH_PW' => $password
        ]);

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());

        $responseArr = json_decode($this->client->getResponse()->getContent(), true);
        $this->assertArrayHasKey('token', $responseArr);
    }
}
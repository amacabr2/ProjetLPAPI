<?php
/**
 * Created by PhpStorm.
 * User: amacabr2
 * Date: 12/11/17
 * Time: 11:33
 */

namespace Tests\UserBundle\Controller;


use Tests\ApiTestCaseBase;

class ForgotPasswordControllerTest extends ApiTestCaseBase {

    public function testSendEmailWhoExist() {
        $this->createUser("matko", "test123");
        $this->makePOSTRequest($this->getData());

        $this->client->request('POST', '/users/resetting', [], [], [
            'CONTENT_TYPE' => 'application/json',
        ], json_encode([
            'email' => 'matko@gmail.com'
        ]));

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
        $this->assertEquals('matko@gmail.com', $this->client->getResponse()->getContent());
    }

    public function testSendEmailWhoNotExist() {
        $this->createUser("matko", "test123");
        $this->makePOSTRequest($this->getData());

        $this->client->request('POST', '/users/resetting', [], [], [
            'CONTENT_TYPE' => 'application/json',
        ], json_encode([
            'email' => 'matko@gmail.com_bad'
        ]));

        $this->assertEquals(404, $this->client->getResponse()->getStatusCode());
        $responseArr = json_decode($this->client->getResponse()->getContent(), true);
        $this->assertEquals('Not Found', $responseArr['error']['message']);
    }
}
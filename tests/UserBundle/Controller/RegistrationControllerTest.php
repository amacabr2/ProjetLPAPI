<?php

namespace Tests\UserBundle\Controller;

use Tests\ApiTestCaseBase;

class RegistrationControllerTest extends ApiTestCaseBase {

    public function testPostRegisterNewUser() {
        $this->makePOSTRequest($this->getData());
        $this->assertEquals(201, $this->client->getResponse()->getStatusCode());
    }

    public function testPostRegisterNewUserWithInvalidEmail() {
        $this->makePOSTRequest($this->getData(null, 'matdkfdfdfdfd'));
        $this->assertEquals(400, $this->client->getResponse()->getStatusCode());
    }

    public function testPostRegisterNewUserWithNotSamePassword(){
        $this->makePOSTRequest($this->getData(null, null, null, 'test456'));
        $this->assertEquals(400, $this->client->getResponse()->getStatusCode());
    }

    /**
     * @param array $data
     * @return void
     */
    private function makePOSTRequest(array $data): void {
        $this->client = static::createClient();
        $this->client->request('POST', '/users/register', [], [], [
            'CONTENT_TYPE' => 'application/json'
        ], json_encode($data));
    }

    /**
     * @param null|string $username
     * @param null|string $email
     * @param null|string $first
     * @param null|string $second
     * @return array
     */
    private function getData(?string $username = null, ?string $email = null, ?string $first =null, ?string $second = null): array {
        return [
            'username' => $username ?: 'matko',
            'email' => $email ?: 'matko@gmail.com',
            'plainPassword' => [
                'first' => $first ?: 'test123',
                'second' => $second ?: 'test123'
            ]
        ];
    }
}

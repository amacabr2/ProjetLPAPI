<?php

namespace Tests\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Client;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class RegistrationControllerTest extends WebTestCase {

    /**
     * @var Client
     */
    private $client;

    public function testPostRegsiterNewUser() {
        $this->makePOSTRequest($this->getData());
        $this->assertEquals(201, $this->client->getResponse()->getStatusCode());
    }

//    public function testPostRegsiterNewUserWithInvalidEmail() {
//        $this->makePOSTRequest($this->getData(null, 'matdkfdfdfdfd'));
//        $this->assertEquals(400, $this->client->getResponse()->getStatusCode());
//    }

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

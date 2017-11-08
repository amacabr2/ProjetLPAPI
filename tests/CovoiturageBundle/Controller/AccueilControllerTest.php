<?php

namespace CovoiturageBundle\Tests\Controller;

use Tests\ApiTestCaseBase;

class AccueilControllerTest extends ApiTestCaseBase {

    public function testGETAccueilMessageForUser() {
        $this->client->request('GET', '/covoiturages/accueil', [], [], [
            'CONTENT_TYPE' => 'application/json',
            'HTTP_AUTHORIZATION' => 'Bearer '. $this->getTokenForTestUser()
        ], []);

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
        $this->assertEquals('Hello user.', json_decode($this->client->getResponse()->getContent(), true));
    }

    public function testGETAccueilMessageAsUnauthorizedUser() {
        $this->client->request('GET', '/covoiturages/accueil', [], [], [
            'CONTENT_TYPE' => 'application/json'
        ], []);

        $this->assertEquals(401, $this->client->getResponse()->getStatusCode());
    }

    /**
     * Creates some user and returns his token
     *
     * @return [string
     */
    private function getTokenForTestUser() {
        $userName = "drle_torca";
        $password = "huligan_kola";

        $user = $this->createUser($userName, $password);

        return $this->getService('lexik_jwt_authentication.encoder')->encode(['username' => $userName]);
    }
}

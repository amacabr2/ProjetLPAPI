<?php

namespace CovoiturageBundle\Tests\Controller;

use Tests\ApiTestCaseBase;

class AccueilControllerTest extends ApiTestCaseBase {

    public function testGETAccueilMessageForUser() {
        $token = $this->getTokenForTestUser();

        $this->client->request('GET', '/covoiturages/accueil', [], [], [
            'CONTENT_TYPE' => 'application/json',
            'HTTP_AUTHORIZATION' => 'Bearer '.$token
        ], []);

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
        $this->assertEquals('Hello user.', json_decode($this->client->getResponse()->getContent(), true));
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

        $token = $this->getService('lexik_jwt_authentication.encoder')->encode(['username' => 'drle_torca']);

        return $token;
    }
}

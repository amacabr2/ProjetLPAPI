<?php

namespace Tests\UserBundle\Controller;

use Tests\ApiTestCaseBase;

class RegistrationControllerTest extends ApiTestCaseBase {

    public function testPostRegisterNewUser() {
        $this->makePOSTRequest($this->getDataUser());
        $this->assertEquals(201, $this->client->getResponse()->getStatusCode());
    }

    public function testPostRegisterNewUserWithInvalidEmail() {
        $this->makePOSTRequest($this->getDataUser(null, 'matdkfdfdfdfd'));
        $this->assertEquals(400, $this->client->getResponse()->getStatusCode());
    }

    public function testPostRegisterNewUserWithNotSamePassword(){
        $this->makePOSTRequest($this->getDataUser(null, null, null, 'test456'));
        $this->assertEquals(400, $this->client->getResponse()->getStatusCode());
    }
}

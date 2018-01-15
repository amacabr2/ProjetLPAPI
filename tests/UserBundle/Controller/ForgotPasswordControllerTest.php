<?php
/**
 * Created by PhpStorm.
 * User: amacabr2
 * Date: 12/11/17
 * Time: 11:33
 */

namespace Tests\UserBundle\Controller;


use Symfony\Component\DomCrawler\Crawler;
use Tests\ApiTestCaseBase;
use UserBundle\Entity\User;

class ForgotPasswordControllerTest extends ApiTestCaseBase {

    public function testSendEmailWhoExist() {
        $this->createUser("matko", "test123");
        $this->makePOSTRequest($this->getDataUser());

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
        $this->makePOSTRequest($this->getDataUser());

        $this->client->request('POST', '/users/resetting', [], [], [
            'CONTENT_TYPE' => 'application/json',
        ], json_encode([
            'email' => 'matko@gmail.com_bad'
        ]));

        $this->assertEquals(404, $this->client->getResponse()->getStatusCode());
        $responseArr = json_decode($this->client->getResponse()->getContent(), true);
        $this->assertEquals('Not Found', $responseArr['message']);
    }

    public function testPOSTChangePasswordGood() {
        $crawler = $this->buildForForm();

        $form = $crawler->filter('button:contains("Valider")')->form();
        $this->client->submit($form, [
            'forgot_password[password]' => "change_password",
            'forgot_password[password_confirmation]' => "change_password"
        ]);

        $this->assertEquals(302, $this->client->getResponse()->getStatusCode());
    }

    public function testPOSTChangePasswordWrongPasswordConfirm() {
        $crawler = $this->buildForForm();

        $form = $crawler->filter('button:contains("Valider")')->form();
        $this->client->submit($form, [
            'forgot_password[password]' => "change_password",
            'forgot_password[password_confirmation]' => "change_password_bad"
        ]);

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
    }

    /**
     * @param null|string $url
     * @return Crawler
     */
    private function buildForForm(?string $url = null): Crawler {
        $user = $this->createUser("matko", "test123");
        $this->makePOSTRequest($this->getDataUser());

        $token_resetting = $this->container->get('token_change_password')->generate(48);
        $user->setPasswordResetToken($token_resetting);

        $id = $user->getId();
        $uri = $url != null ? $url : "change-password/{$id}/{$token_resetting}";

        $crawler = $this->client->request('POST', $uri, [], [], [
            'CONTENT_TYPE' => 'application/json',
        ], json_encode([
            'email' => 'matko@gmail.com'
        ]));

        return $crawler;
    }
}
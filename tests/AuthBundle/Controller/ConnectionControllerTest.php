<?php
/**
 * Created by PhpStorm.
 * User: amacabr2
 * Date: 31/10/17
 * Time: 09:18
 */

namespace AuthBundle\Tests\Controller;


use AuthBundle\Entity\Credentials;
use AuthBundle\Entity\PrincipaleUtilisateur;
use GuzzleHttp\Client;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ConnectionControllerTest extends WebTestCase {

    /**
     * Test si la connection se fait correctement
     */
    public function testSimpleConnectionWithValidPassword() {
        $credentials = new Credentials();
        $credentials->setLogin("anthony.macabrey@edu.univ-fcomte.fr");
        $credentials->setPassword("sub@bg10");

        $client = new Client([
            'base_uri'        => 'http://localhost:8000'
        ]);
        $json = json_encode([
            "login" => $credentials->getLogin(),
            "password" => $credentials->getPassword()
        ]);

        $request = $client->request('POST', '/api/connection', ['form_param' => $json]);
        $this->assertEquals(201, $request->getStatusCode());
        //$this->assertEquals('sub@bg10', $request->getBody());
    }

    public function testSimpleConnectionWihInvalidPassword() {
        $credentials = new Credentials();
        $credentials->setLogin("anthony.macabrey@edu.univ-fcomte.fr");
        $credentials->setPassword("sub@bg10");

        $client = new Client([
            'base_uri'        => 'http://localhost:8000'
        ]);
        $json = json_encode([
            "login" => $credentials->getLogin(),
            "password" => $credentials->getPassword()
        ]);

        $request = $client->request('POST', '/api/connection', ['form_param' => $json]);
        $this->assertEquals(201, $request->getStatusCode());
    }
}
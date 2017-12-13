<?php
/**
 * Created by PhpStorm.
 * User: amacabr2
 * Date: 05/11/17
 * Time: 11:19
 */

namespace Tests;


use Doctrine\Common\DataFixtures\Purger\ORMPurger;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Bundle\FrameworkBundle\Client;
use UserBundle\Entity\User;

class ApiTestCaseBase extends WebTestCase {

    protected $container;

    protected $em;

    /**
     * @var Client
     */
    protected $client;

    protected static $staticClient;

    public static function setUpBeforeClass() {
        self::$staticClient = static::createClient(['environnement' => 'test']);
        self::bootKernel();
    }

    protected function tearDown() {

    }

    protected function setUp() {
        $kernel = static::$kernel;
        $this->container = $kernel->getContainer();
        $this->em = $kernel->getContainer()
            ->get('doctrine')
            ->getManager();
        $this->client = self::$staticClient;
        $this->purgeDatabase();
    }

    /**
     * @param string $username
     * @param string $password
     * @return User
     */
    protected function createUser(string $username, string $password): User {
        $userManager = $this->getService('fos_user.user_manager');

        /** @var User $user */
        $user = $userManager->createUser();
        $user->setEnabled(true);
        $user->setUsername($username);
        $user->setPlainPassword($password);
        $user->setEmail('matko@gmail.com');
        $userManager->updateUser($user);

        return $user;
    }

    /**
     * @param array $data
     * @return void
     */
    protected function makePOSTRequest(array $data): void {
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
    protected function getData(?string $username = null, ?string $email = null, ?string $first =null, ?string $second = null): array {
        return [
            'username' => $username ?: 'matko1',
            'plainPassword' => [
                'first' => $first ?: 'test123',
                'second' => $second ?: 'test123'
            ],
            'email' => $email ?: 'matko1@gmail.com',
            'prenom' => "Azerty",
            'nom' => "Qwerty",
            'civilite' => "Monsieur",
            'dateNaissance' => "15/02/1997",
            'telFixe' => "0345678900",
            'telPortable' => "0654321000",
            'fichier' => "azerty.jpg",
            'newsletter' => true,
            'presentation' => "azerty-qwerty",
            'localisation' => [
                'adresse' => "2 rue Ernest Duvillard",
                'ville' => "Belfort",
                'codePostal' => "90000"
            ]
        ];
    }

    protected function getService(string $id) {
        return self::$kernel->getContainer()->get($id);
    }

    private function purgeDatabase() {
        $purger = new ORMPurger($this->getService('doctrine')->getManager());
        $purger->purge();
    }
}
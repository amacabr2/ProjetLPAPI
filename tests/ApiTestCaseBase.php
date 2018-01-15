<?php
/**
 * Created by PhpStorm.
 * User: amacabr2
 * Date: 05/11/17
 * Time: 11:19
 */

namespace Tests;


use CovoiturageBundle\Entity\Localisation;
use CovoiturageBundle\Entity\Trajet;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Bundle\FrameworkBundle\Client;
use UserBundle\Entity\User;

class ApiTestCaseBase extends WebTestCase {

    protected $container;

    protected $doctrine;

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
        $this->doctrine = $kernel->getContainer()->get('doctrine');
        $this->em = $this->doctrine->getManager();
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
    protected function getDataUser(?string $username = null, ?string $email = null, ?string $first = null, ?string $second = null): array {
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

    protected function buildUser(array $data): User {
        $user = new User();
        $user->setUsername($data['username']);
        $user->setPrenom($data['prenom']);
        $user->setNom($data['nom']);
        $user->setEmail($data['email']);
        $user->setCivilite($data['civilite']);
        $user->setDateNaissance($data['dateNaissance']);
        $user->setTelFixe($data['telFixe']);
        $user->setTelPortable($data['telPortable']);
        $user->setFichier($data['fichier']);
        $user->setNewsletter($data['newsletter']);
        $user->setPresentation($data['presentation']);
        $user->setPassword($data['plainPassword']['first']);
        $user->setLocalisation($this->buildLocalisation("2 rue Ernest Duvillard", "Belfort", "90000", "France", 47.643657, 6.836957, false, false, "2017-12-06T08:39:09+00:00"));

        $this->em->persist($user);
        $this->em->flush();
        return $user;
    }

    protected function buildTrajet(): Trajet {
        $trajet = new Trajet();
        $trajet->setNbPlaceRestante(4);
        $loc1 = $this->buildLocalisation("2 rue Ernest Duvillard", "Belfort", "90000", "France", 47.643657, 6.836957, true, false, "2017-12-06T08:39:09+00:00");
        $loc2 = $this->buildLocalisation("18 Rue Alfred Bouvier", "Belfort", "90000", "France", 47.643976, 6.834586, true, false, "2017-12-06T08:39:09+00:00");
        $trajet->addLocalisation($loc1);
        $trajet->addLocalisation($loc2);
        $trajet->setUserConducteur($this->buildUser($this->getDataUser()));

        $this->em->persist($trajet);
        $this->em->flush();
        return $trajet;
    }

    protected function buildLocalisation(string $adresse, string $ville, string $codePostal, string $pays, float $latitude, float $longitude, bool $isDepart, bool $isArrivee, string $horaire): Localisation {
        $localisation = new Localisation();
        $localisation->setAdresse($adresse);
        $localisation->setVille($ville);
        $localisation->setCodePostal($codePostal);
        $localisation->setPays($pays);
        $localisation->setLatitude($latitude);
        $localisation->setLongitude($longitude);
        $localisation->setIsDepart($isDepart);
        $localisation->setIsArrivee($isArrivee);
        $localisation->setHoraire(new \DateTime($horaire));

        $this->em->persist($localisation);
        $this->em->flush();
        return $localisation;
    }

    private function purgeDatabase() {
        $purger = new ORMPurger($this->getService('doctrine')->getManager());
        $purger->purge();
    }
}
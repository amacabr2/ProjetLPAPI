<?php
/**
 * Created by PhpStorm.
 * User: antho
 * Date: 20/12/2017
 * Time: 08:39
 */

namespace CovoiturageBundle\Tests\Controller;


use CovoiturageBundle\Entity\Trajet;
use Tests\ApiTestCaseBase;
use UserBundle\Entity\User;

class TrajetControllerTest extends ApiTestCaseBase {

    public function testJoinTrajet() {
        $entityManagerMock = $this->getMockBuilder('Doctrine\ORM\EntityManager')
            ->setMethods(['merge', 'flush'])
            ->disableOriginalConstructor()
            ->getMock();
        $entityManagerMock->expects($this->once())->method('flush');

        /** @var User $user */
        $user = $this->buildUser($this->getDataUser("patrick", "patrick@gmail.com"));
        /** @var Trajet $trajet */
        $trajet = $this->buildTrajet();

        $this->assertEquals(2, sizeof($trajet->getLocalisations()));

        $localisation = $this->buildLocalisation("Parc d'Activités Techn'hom 1", "Belfort", "90000", "France", 47.643792, 6.845291, false, false, "2017-12-06T09:12:09+00:00");
        $data = [
            'trajet_id' => $trajet->getId(),
            'user_id' => $user->getId(),
            'localisation' => json_encode($localisation)
        ];

        $this->container->set('doctrine.orm.default_entuty_manager', $entityManagerMock);
        $this->client->request('POST', '/covoiturages/trajets/rejoindre', [], [], [
            'CONTENT_TYPE' => 'application/json',
        ], json_encode($data));

        $this->assertEquals(201, $this->client->getResponse()->getStatusCode());
        var_dump($this->client->getResponse()->getContent());
        $this->assertEquals(3, sizeof($trajet->getLocalisations()));
    }
}
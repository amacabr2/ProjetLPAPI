<?php
/**
 * Created by PhpStorm.
 * User: amacabr2
 * Date: 29/11/17
 * Time: 18:41
 */

namespace UserBundle\DataFixtures;


use Doctrine\Bundle\FixturesBundle\Fixture;

abstract class FakerFixture extends Fixture {

    public function getFaker() {
        return $this->container->get('davidbadura_faker.faker');
    }
}
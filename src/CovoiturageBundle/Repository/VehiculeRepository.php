<?php

namespace CovoiturageBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * VehiculeRepository
 *
 * This class was generated by the PhpStorm "Php Annotations" Plugin. Add your own custom
 * repository methods below.
 */
class VehiculeRepository extends EntityRepository {

    public function findAllByUser(int $userId) {
        $qb = $this->createQueryBuilder('v')
            ->innerJoin('v.users', 'u');

        $qb->where('u.id = :id')
            ->setParameter('id', $userId);

        return $qb->getQuery()->getResult();
    }
}
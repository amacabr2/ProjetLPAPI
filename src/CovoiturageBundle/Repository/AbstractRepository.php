<?php
/**
 * Created by PhpStorm.
 * User: antho
 * Date: 19/02/2018
 * Time: 13:52
 */

namespace CovoiturageBundle\Repository;


use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;
use Pagerfanta\Adapter\DoctrineORMAdapter;
use Pagerfanta\Pagerfanta;

class AbstractRepository extends EntityRepository {

    protected function paginate(QueryBuilder $qb, $limit = 20, $offset = 0) {
        if ($limit == 0 || $offset == 0) {
            throw new \LogicException('$limit & $offstet must be greater than 0.');
        }

        $pager = new Pagerfanta(new DoctrineORMAdapter($qb));
        $currentPage = ceil(($offset + 1) / $limit);
        $pager->setCurrentPage($currentPage);
        $pager->setMaxPerPage((int) $limit);

        return $pager;
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: Oskar Adamczyk
 * Date: 19.01.18
 * Time: 11:58
 */

namespace AppBundle\Repository;


use Doctrine\ORM\QueryBuilder;
use Symfony\Component\HttpFoundation\ParameterBag;

/**
 * Interface CountableRepositoryInterface
 * @package AppBundle\Repository
 */
interface CountableRepositoryInterface
{
    /**
     * @param QueryBuilder $qb
     */
    public function decorateCountQB(QueryBuilder $qb): void;

    /**
     * @param ParameterBag $filters
     * @return int
     */
    public function getCount(ParameterBag $filters): int;
}

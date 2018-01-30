<?php
/**
 * Created by PhpStorm.
 * User: Oskar Adamczyk
 * Date: 19.01.18
 * Time: 12:13
 */

namespace AppBundle\Decorator;


use Doctrine\ORM\QueryBuilder;

class CountableQBDecorator implements QBDecoratorInterface
{
    /**
     * @param QueryBuilder $qb
     */
    public function decorateQB(QueryBuilder $qb): void
    {
        $qb->select(sprintf('COUNT(1)'));
    }

    /**
     * @param QueryBuilder $qb
     * @return int
     */
    public function getDecoratedResult(QueryBuilder $qb): int
    {
        return $qb->getQuery()->getSingleScalarResult();
    }
}

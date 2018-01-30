<?php
/**
 * Created by PhpStorm.
 * User: Oskar Adamczyk
 * Date: 19.01.18
 * Time: 12:11
 */

namespace AppBundle\Decorator;


use Doctrine\ORM\QueryBuilder;

interface QBDecoratorInterface
{
    /**
     * @param QueryBuilder $qb
     */
    public function decorateQB(QueryBuilder $qb): void;

    /**
     * @param QueryBuilder $qb
     * @return int
     */
    public function getDecoratedResult(QueryBuilder $qb): int;
}
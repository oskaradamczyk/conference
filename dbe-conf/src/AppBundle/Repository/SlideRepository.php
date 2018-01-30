<?php
/**
 * Created by PhpStorm.
 * User: Oskar Adamczyk
 * Date: 19.01.18
 * Time: 11:37
 */

namespace AppBundle\Repository;


use Doctrine\ORM\QueryBuilder;
use Symfony\Component\HttpFoundation\ParameterBag;

/**
 * Class SlideRepository
 * @package AppBundle\Repository
 */
class SlideRepository extends DecoratedRepository
{
    /**
     * @param ParameterBag $filters
     * @return QueryBuilder
     */
    public function getFilteredQB(ParameterBag $filters): QueryBuilder
    {
        $qb = $this->createQueryBuilder('s');
        if ($filters->get('active')) {
            $qb->andWhere('s.active = true');
        }
        if ($lecture = $filters->get('lecture')) {
            $qb
                ->andWhere('s.lecture = :lecture')
                ->setParameter('lecture', $lecture);
        }
        return $qb;
    }
}

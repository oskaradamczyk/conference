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
 * Class LectureRepository
 * @package AppBundle\Repository
 */
class LectureRepository extends DecoratedRepository
{
    /**
     * @param ParameterBag $filters
     * @return QueryBuilder
     */
    public function getFilteredQB(ParameterBag $filters): QueryBuilder
    {
        $qb = $this->createQueryBuilder('l');
        if ($id = $filters->get('id')) {
            $qb
                ->andWhere('l.id = :id')
                ->setParameter('id', $id);
            return $qb;
        }
        if ($filters->get('active')) {
            $qb
                ->leftJoin('l.section', 'ls')
                ->andWhere('l.active = true')
                ->andWhere('ls.active = true');
        }
        return $qb;
    }
}

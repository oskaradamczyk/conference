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
 * Class SectionRepository
 * @package AppBundle\Repository
 */
class SectionRepository extends QBAwareRepository
{
    /**
     * @param ParameterBag $filters
     * @return QueryBuilder
     */
    public function getFilteredQB(ParameterBag $filters): QueryBuilder
    {
        $qb = $this->createQueryBuilder('s');
        if ($filters->get('active')) {
            $qb
                ->andWhere('s.active = true');
        }
        return $qb;
    }
}

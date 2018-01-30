<?php
/**
 * Created by PhpStorm.
 * User: Oskar Adamczyk
 * Date: 25.01.18
 * Time: 14:42
 */

namespace AppBundle\Repository;


use Doctrine\ORM\QueryBuilder;
use Symfony\Component\HttpFoundation\ParameterBag;

/**
 * Class QuestionRepository
 * @package AppBundle\Repository
 */
class QuestionRepository extends DecoratedRepository
{
    /**
     * @param ParameterBag $filters
     * @return QueryBuilder
     */
    public function getFilteredQB(ParameterBag $filters): QueryBuilder
    {
        $qb = $this->createQueryBuilder('q');
        if ($filters->get('accepted')) {
            $qb
                ->andWhere('q.accepted = true');
        }
        if (!is_null($answered = $filters->get('answered'))) {
            $qb
                ->andWhere('q.answered = :answered')
                ->setParameter('answered', $answered);
        }
        if ($sectionId = $filters->get('section')) {
            $qb
                ->leftJoin('q.lecture', 'ql')
                ->andWhere('ql.section = :section')
                ->setParameter('section', $sectionId);
            return $qb;
        }
        if ($lectureId = $filters->get('lecture')) {
            $qb
                ->andWhere('q.lecture = :lecture')
                ->setParameter('lecture', $lectureId);
        }
        return $qb;
    }
}
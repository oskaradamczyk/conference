<?php
/**
 * Created by PhpStorm.
 * User: Oskar Adamczyk
 * Date: 23.01.18
 * Time: 16:51
 */

namespace AppBundle\Repository;


use AppBundle\Model\AbstractModelInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\HttpFoundation\ParameterBag;

/**
 * Class QBAwareRepository
 * @package AppBundle\Repository
 */
abstract class QBAwareRepository extends EntityRepository implements QBAwareRepositoryInterface
{
    /**
     * @param ParameterBag $filters
     * @return AbstractModelInterface|null
     */
    public function getFilteredResult(ParameterBag $filters): ?AbstractModelInterface
    {
        $qb = $this->getFilteredQB($filters);
        return $qb->getQuery()->getOneOrNullResult();
    }

    /**
     * @param ParameterBag $filters
     * @return array
     */
    public function getFilteredResults(ParameterBag $filters): array
    {
        $qb = $this->getFilteredQB($filters);
        return $qb->getQuery()->getResult();
    }
}

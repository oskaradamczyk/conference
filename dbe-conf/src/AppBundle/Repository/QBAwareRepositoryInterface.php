<?php
/**
 * Created by PhpStorm.
 * User: Oskar Adamczyk
 * Date: 19.01.18
 * Time: 13:50
 */

namespace AppBundle\Repository;


use AppBundle\Model\AbstractModelInterface;
use Doctrine\ORM\QueryBuilder;
use Symfony\Component\HttpFoundation\ParameterBag;

/**
 * Interface QBAwareRepositoryInterface
 * @package AppBundle\Repository
 */
interface QBAwareRepositoryInterface
{
    /**
     * @param ParameterBag $filters
     * @return QueryBuilder
     */
    public function getFilteredQB(ParameterBag $filters): QueryBuilder;

    /**
     * @param ParameterBag $filters
     * @return AbstractModelInterface|null
     */
    public function getFilteredResult(ParameterBag $filters): ?AbstractModelInterface;

    /**
     * @param ParameterBag $filters
     * @return array
     */
    public function getFilteredResults(ParameterBag $filters): array;
}
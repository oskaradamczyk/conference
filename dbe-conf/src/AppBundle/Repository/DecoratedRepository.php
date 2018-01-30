<?php
/**
 * Created by PhpStorm.
 * User: Oskar Adamczyk
 * Date: 19.01.18
 * Time: 12:10
 */

namespace AppBundle\Repository;


use AppBundle\Decorator\QBDecoratorInterface;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;
use Symfony\Component\HttpFoundation\ParameterBag;

/**
 * Class DecoratedRepository
 * @package AppBundle\Repository
 */
abstract class DecoratedRepository extends QBAwareRepository implements DecoratedRepositoryInterface
{
    /** @var QBDecoratorInterface */
    protected $decorator;

    /**
     * @param QBDecoratorInterface $decorator
     * @return DecoratedRepositoryInterface
     */
    public function setDecorator(QBDecoratorInterface $decorator): DecoratedRepositoryInterface
    {
        $this->decorator = $decorator;
        return $this;
    }

    /**
     * @param ParameterBag $filters
     * @return int
     */
    public function getDecoratedResult(ParameterBag $filters): int
    {
        $qb = $this->getFilteredQB($filters);
        $this->decorateCountQB($qb);
        return $this->decorator->getDecoratedResult($qb);
    }

    /**
     * @param QueryBuilder $qb
     */
    public function decorateCountQB(QueryBuilder $qb): void
    {
        $this->decorator->decorateQB($qb);
    }
}

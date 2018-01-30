<?php
/**
 * Created by PhpStorm.
 * User: Oskar Adamczyk
 * Date: 19.01.18
 * Time: 12:30
 */

namespace AppBundle\Repository;


use AppBundle\Decorator\QBDecoratorInterface;

/**
 * Interface DecoratedRepositoryInterface
 * @package AppBundle\Repository
 */
interface DecoratedRepositoryInterface
{
    /**
     * @param QBDecoratorInterface $decorator
     * @return DecoratedRepositoryInterface
     */
    public function setDecorator(QBDecoratorInterface $decorator): DecoratedRepositoryInterface;
}

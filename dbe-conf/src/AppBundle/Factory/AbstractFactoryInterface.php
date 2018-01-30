<?php
/**
 * Created by PhpStorm.
 * User: Oskar Adamczyk
 * Date: 18.01.18
 * Time: 14:35
 */

namespace AppBundle\Factory;


use AppBundle\Handler\AbstractHandlerInterface;
use AppBundle\Service\AbstractServiceInterface;

/**
 * Interface AbstractFactoryInterface
 * @package AppBundle\Factory
 */
interface AbstractFactoryInterface
{
    /**
     * @return AbstractServiceInterface
     */
    public function createService(): AbstractServiceInterface;

    /**
     * @return AbstractHandlerInterface
     */
    public function createHandler(): AbstractHandlerInterface;
}

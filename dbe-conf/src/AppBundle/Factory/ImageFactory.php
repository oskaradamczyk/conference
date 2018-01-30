<?php
/**
 * Created by PhpStorm.
 * User: Oskar Adamczyk
 * Date: 22.01.18
 * Time: 15:48
 */

namespace AppBundle\Factory;


use AppBundle\Handler\AbstractHandlerInterface;
use AppBundle\Service\AbstractServiceInterface;

/**
 * Class ImageFactory
 * @package AppBundle\Factory
 */
class ImageFactory extends AbstractFactory
{
    public function createService(): AbstractServiceInterface
    {
        // TODO: Implement createService() method.
    }

    /**
     * @return AbstractHandlerInterface
     */
    public function createHandler(): AbstractHandlerInterface
    {
        // TODO: Implement createHandler() method.
    }
}
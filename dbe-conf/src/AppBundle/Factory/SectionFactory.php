<?php
/**
 * Created by PhpStorm.
 * User: Oskar Adamczyk
 * Date: 23.01.18
 * Time: 15:23
 */

namespace AppBundle\Factory;


use AppBundle\Handler\AbstractHandlerInterface;
use AppBundle\Service\AbstractServiceInterface;
use AppBundle\Service\SectionService;

/**
 * Class SectionFactory
 * @package AppBundle\Factory
 */
class SectionFactory extends AbstractFactory
{
    public function createService(): AbstractServiceInterface
    {
        return new SectionService($this->em, $this->eventDispatcher, $this->modelClassName);
    }

    public function createHandler(): AbstractHandlerInterface
    {
        // TODO: Implement createHandler() method.
    }
}

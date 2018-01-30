<?php
/**
 * Created by PhpStorm.
 * User: Oskar Adamczyk
 * Date: 19.01.18
 * Time: 11:16
 */

namespace AppBundle\Factory;


use AppBundle\Decorator\CountableQBDecorator;
use AppBundle\Handler\AbstractHandlerInterface;
use AppBundle\Handler\GuestHandler;
use AppBundle\Handler\LectureHandler;
use AppBundle\Service\AbstractServiceInterface;
use AppBundle\Service\GuestService;
use AppBundle\Service\LectureService;

/**
 * Class GuestFactory
 * @package AppBundle\Factory
 */
class GuestFactory extends AbstractFactory
{
    /**
     * @return AbstractServiceInterface
     */
    public function createService(): AbstractServiceInterface
    {
        return new GuestService($this->em, $this->eventDispatcher, $this->modelClassName, $this->translator);
    }

    /**
     * @return AbstractHandlerInterface
     */
    public function createHandler(): AbstractHandlerInterface
    {
        return new GuestHandler($this->createService());
    }
}

<?php
/**
 * Created by PhpStorm.
 * User: Oskar Adamczyk
 * Date: 19.01.18
 * Time: 14:57
 */

namespace AppBundle\Factory;


use AppBundle\Decorator\CountableQBDecorator;
use AppBundle\Handler\AbstractHandlerInterface;
use AppBundle\Handler\SlideHandler;
use AppBundle\Service\AbstractServiceInterface;
use AppBundle\Service\SlideService;

/**
 * Class SlideFactory
 * @package AppBundle\Factory
 */
class SlideFactory extends AbstractFactory
{
    /**
     * @return AbstractServiceInterface
     */
    public function createService(): AbstractServiceInterface
    {
        $slService = new SlideService($this->em, $this->eventDispatcher, $this->modelClassName, $this->translator);
        $slService->initializeRepository(new CountableQBDecorator());
        return $slService;
    }

    /**
     * @return AbstractHandlerInterface
     */
    public function createHandler(): AbstractHandlerInterface
    {
        return new SlideHandler($this->createService());
    }
}

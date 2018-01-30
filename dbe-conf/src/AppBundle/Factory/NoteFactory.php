<?php
/**
 * Created by PhpStorm.
 * User: Oskar Adamczyk
 * Date: 25.01.18
 * Time: 09:40
 */

namespace AppBundle\Factory;


use AppBundle\Handler\AbstractHandlerInterface;
use AppBundle\Handler\NoteHandler;
use AppBundle\Service\AbstractServiceInterface;
use AppBundle\Service\NoteService;

/**
 * Class NoteFactory
 * @package AppBundle\Factory
 */
class NoteFactory extends AbstractFactory
{
    /**
     * @return AbstractServiceInterface
     */
    public function createService(): AbstractServiceInterface
    {
        return new NoteService($this->em, $this->eventDispatcher, $this->modelClassName, $this->translator);
    }

    /**
     * @return AbstractHandlerInterface
     */
    public function createHandler(): AbstractHandlerInterface
    {
        return new NoteHandler($this->createService());
    }
}

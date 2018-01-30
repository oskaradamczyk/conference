<?php
/**
 * Created by PhpStorm.
 * User: Oskar Adamczyk
 * Date: 25.01.18
 * Time: 12:48
 */

namespace AppBundle\Factory;


use AppBundle\Handler\AbstractHandlerInterface;
use AppBundle\Handler\QuestionHandler;
use AppBundle\Service\AbstractServiceInterface;
use AppBundle\Service\QuestionService;

/**
 * Class QuestionFactory
 * @package AppBundle\Factory
 */
class QuestionFactory extends AbstractFactory
{
    /**
     * @return AbstractServiceInterface
     */
    public function createService(): AbstractServiceInterface
    {
        return new QuestionService($this->em, $this->eventDispatcher, $this->modelClassName, $this->translator);
    }

    /**
     * @return AbstractHandlerInterface
     */
    public function createHandler(): AbstractHandlerInterface
    {
        return new QuestionHandler($this->createService());
    }
}

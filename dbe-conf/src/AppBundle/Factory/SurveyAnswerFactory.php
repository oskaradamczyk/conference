<?php
/**
 * Created by PhpStorm.
 * User: Oskar Adamczyk
 * Date: 29.01.18
 * Time: 11:12
 */

namespace AppBundle\Factory;


use AppBundle\Handler\AbstractHandlerInterface;
use AppBundle\Handler\SurveyAnswerHandler;
use AppBundle\Service\AbstractServiceInterface;
use AppBundle\Service\SurveyAnswerService;

/**
 * Class SurveyAnswerFactory
 * @package AppBundle\Factory
 */
class SurveyAnswerFactory extends AbstractFactory
{
    /**
     * @return AbstractServiceInterface
     */
    public function createService(): AbstractServiceInterface
    {
        return new SurveyAnswerService($this->em, $this->eventDispatcher, $this->modelClassName, $this->translator);

    }

    /**
     * @return AbstractHandlerInterface
     */
    public function createHandler(): AbstractHandlerInterface
    {
        return new SurveyAnswerHandler($this->createService());
    }
}

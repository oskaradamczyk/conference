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
use AppBundle\Handler\LectureHandler;
use AppBundle\Service\AbstractServiceInterface;
use AppBundle\Service\LectureService;

/**
 * Class LectureFactory
 * @package AppBundle\Factory
 */
class LectureFactory extends AbstractFactory
{
    /**
     * @return AbstractServiceInterface
     */
    public function createService(): AbstractServiceInterface
    {
        return new LectureService($this->em, $this->eventDispatcher, $this->modelClassName, $this->validator, $this->translator);
    }

    /**
     * @return AbstractHandlerInterface
     */
    public function createHandler(): AbstractHandlerInterface
    {
        return new LectureHandler($this->createService(), $this->archiveTempDir, $this->uploadDir);
    }
}

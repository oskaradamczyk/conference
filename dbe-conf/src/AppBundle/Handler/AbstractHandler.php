<?php
/**
 * Created by PhpStorm.
 * User: Oskar Adamczyk
 * Date: 22.01.18
 * Time: 11:16
 */

namespace AppBundle\Handler;


use AppBundle\Service\AbstractServiceInterface;

/**
 * Class AbstractHandler
 * @package AppBundle\Handler
 */
abstract class AbstractHandler implements AbstractHandlerInterface
{
    /** @var AbstractServiceInterface */
    protected $service;

    /**
     * AbstractHandler constructor.
     * @param AbstractServiceInterface $service
     */
    public function __construct(AbstractServiceInterface $service)
    {
        $this->service = $service;
    }
}

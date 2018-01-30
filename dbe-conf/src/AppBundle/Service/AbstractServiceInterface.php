<?php
/**
 * Created by PhpStorm.
 * User: Oskar Adamczyk
 * Date: 19.01.18
 * Time: 11:06
 */

namespace AppBundle\Service;


use AppBundle\Model\AbstractModelInterface;
use AppBundle\Model\InitializeableModelInterface;
use AppBundle\Repository\QBAwareRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\ParameterBag;

/**
 * Interface AbstractServiceInterface
 * @package AppBundle\Service
 */
interface AbstractServiceInterface
{
    /**
     * @return EntityManagerInterface
     */
    public function getManager(): EntityManagerInterface;

    /**
     * @return EventDispatcherInterface
     */
    public function getEventDispatcher(): EventDispatcherInterface;

    /**
     * @return EntityRepository|QBAwareRepository
     */
    public function getRepository(): EntityRepository;

    /**
     * @param AbstractModelInterface $model
     */
    public function save(AbstractModelInterface $model): void;

    /**
     * @param AbstractModelInterface $model
     * @param ParameterBag $parameters
     */
    public function update(AbstractModelInterface $model, ParameterBag $parameters): void;

    /**
     * @param ParameterBag $args
     * @return InitializeableModelInterface
     */
    public function create(ParameterBag $args): InitializeableModelInterface;
}
<?php
/**
 * Created by PhpStorm.
 * User: Oskar Adamczyk
 * Date: 19.01.18
 * Time: 13:55
 */

namespace AppBundle\Service;


use AppBundle\Decorator\QBDecoratorInterface;

/**
 * Interface RepositoryInitializedServiceInterface
 * @package AppBundle\Service
 */
interface RepositoryInitializedServiceInterface
{
    /**
     * @param QBDecoratorInterface $decorator
     */
    public function initializeRepository(QBDecoratorInterface $decorator): void;
}
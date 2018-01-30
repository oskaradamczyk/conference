<?php
/**
 * Created by PhpStorm.
 * User: Oskar Adamczyk
 * Date: 22.01.18
 * Time: 14:16
 */

namespace AppBundle\Handler;


/**
 * Interface UploadableHandlerInterface
 * @package AppBundle\Handler
 */
interface UploadableHandlerInterface
{
    public function initTempDir(): void;

    public function clearTempDir(): void;
}

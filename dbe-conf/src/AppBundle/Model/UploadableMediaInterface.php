<?php
/**
 * Created by PhpStorm.
 * User: Oskar Adamczyk
 * Date: 22.01.18
 * Time: 10:13
 */

namespace AppBundle\Model;


use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Interface UploadableMediaInterface
 * @package AppBundle\Model
 */
interface UploadableMediaInterface
{
    /**
     * @return string
     */
    public function getFileName();

    /**
     * @param string $name
     */
    public function setFileName(string $name): void;

    /**
     * @return string
     */
    public function getFileUrl();

    /**
     * @param $thumbnailUrl
     */
    public function setFileUrl($thumbnailUrl): void;

    /**
     * @return File|UploadedFile
     */
    public function getFile();

    /**
     * @param File|null $file
     */
    public function setFile(File $file = null): void;
}
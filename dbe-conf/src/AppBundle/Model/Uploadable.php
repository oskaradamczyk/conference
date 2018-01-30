<?php
/**
 * Created by PhpStorm.
 * User: Oskar Adamczyk
 * Date: 22.01.18
 * Time: 11:28
 */

namespace AppBundle\Model;


use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;

interface Uploadable
{
    /**
     * @return File|UploadedFile
     */
    public function getFile();
}
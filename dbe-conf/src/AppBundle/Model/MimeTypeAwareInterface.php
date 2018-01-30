<?php
/**
 * Created by PhpStorm.
 * User: Oskar Adamczyk
 * Date: 19.01.18
 * Time: 17:14
 */

namespace AppBundle\Model;


/**
 * Interface MimeTypeAwareInterface
 * @package AppBundle\Model
 */
interface MimeTypeAwareInterface
{
    /**
     * @return string
     */
    public function getMimeType(): string;

    /**
     * @return array
     */
    public function getAllowedMimeTypes(): array;
}

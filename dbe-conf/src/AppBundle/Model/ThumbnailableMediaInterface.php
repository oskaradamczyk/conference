<?php
/**
 * Created by PhpStorm.
 * User: Oskar Adamczyk
 * Date: 30.01.18
 * Time: 12:10
 */

namespace AppBundle\Model;


/**
 * Interface ThumbnailableMediaInterface
 * @package AppBundle\Model
 */
interface ThumbnailableMediaInterface extends UploadableMediaInterface
{
    /**
     * @return string
     */
    public function getThumbnailUrl();

    /**
     * @param $thumbnailUrl
     */
    public function setThumbnailUrl($thumbnailUrl): void;
}

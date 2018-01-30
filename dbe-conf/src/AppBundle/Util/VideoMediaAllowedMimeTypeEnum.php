<?php
/**
 * Created by PhpStorm.
 * User: Oskar Adamczyk
 * Date: 07.09.17
 * Time: 14:26
 */

namespace AppBundle\Util;

class VideoMediaAllowedMimeTypeEnum
{
    use Enum;

    const MP4_MIME_TYPE = 'video/mp4';
    const QUICKTIME_MIME_TYPE = 'video/quicktime';
    const AVI_MIME_TYPE = 'video/avi';
}
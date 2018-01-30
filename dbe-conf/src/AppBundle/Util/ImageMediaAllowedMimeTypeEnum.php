<?php
/**
 * Created by PhpStorm.
 * User: Oskar Adamczyk
 * Date: 07.09.17
 * Time: 14:26
 */

namespace AppBundle\Util;

class ImageMediaAllowedMimeTypeEnum
{
    use Enum;

    const JPG_MIME_TYPE = 'image/jpg';
    const JPEG_MIME_TYPE = 'image/jpeg';
    const PNG_MIME_TYPE = 'image/png';
    const GIF_MIME_TYPE = 'image/gif';


}
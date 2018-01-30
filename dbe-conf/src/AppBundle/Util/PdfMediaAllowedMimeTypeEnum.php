<?php
/**
 * Created by PhpStorm.
 * User: Oskar Adamczyk
 * Date: 07.09.17
 * Time: 14:26
 */

namespace AppBundle\Util;

class PdfMediaAllowedMimeTypeEnum
{
    use Enum;

    const PDF_MIME_TYPE = 'application/pdf';
    const X_PDF_MIME_TYPE = 'application/x-pdf';
}
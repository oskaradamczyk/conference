<?php
/**
 * Created by PhpStorm.
 * User: Oskar Adamczyk
 * Date: 19.01.18
 * Time: 15:56
 */

namespace AppBundle\Model;


use AppBundle\Util\ArchiveMediaAllowedMimeTypeEnum;
use AppBundle\Util\Enum;
use AppBundle\Validator\Constraints as AppAssert;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Import
 * @package AppBundle\Model
 */
abstract class Import implements MimeTypeAwareInterface, Uploadable
{
    const ALLOWED_MIME_TYPES_ENUM = ArchiveMediaAllowedMimeTypeEnum::class;

    /**
     * @var UploadedFile|File
     *
     * @Assert\File()
     * @AppAssert\ProperMimeType
     */
    protected $file;

    /**
     * @return array
     */
    public function getAllowedMimeTypes(): array
    {
        /** @var Enum $enum */
        $enum = self::ALLOWED_MIME_TYPES_ENUM;
        return $enum::getConstants();
    }

    /**
     * @return File|UploadedFile
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * @param File|UploadedFile $file
     * @return Import
     */
    public function setFile($file)
    {
        $this->file = $file;
        return $this;
    }

    /**
     * @return string
     */
    public function getMimeType(): string
    {
        return $this->file->getClientMimeType();
    }
}
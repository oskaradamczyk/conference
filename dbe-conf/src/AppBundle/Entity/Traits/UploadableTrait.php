<?php
/**
 * Created by PhpStorm.
 * User: Oskar Adamczyk
 * Date: 17.01.18
 * Time: 15:47
 */

namespace AppBundle\Entity\Traits;


use AppBundle\Util\Enum;
use AppBundle\Validator\Constraints as AppAssert;
use JMS\Serializer\Annotation as JMS;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * Traits UploadableTrait
 * @package AppBundle\Entity\Traits
 * @JMS\ExclusionPolicy("all")
 */
trait UploadableTrait
{
    /**
     * @var string
     *
     * @ORM\Column(type="text")
     */
    protected $fileName;

    /**
     * Virtual field for dynamic listener url generator
     *
     * @var string
     * @JMS\Expose()
     */
    protected $fileUrl;

    /**
     * Virtual field for dynamic listener url generator
     *
     * @var string
     * @JMS\Expose()
     */
    protected $thumbnailUrl;

    /**
     * @var File|UploadedFile
     * @Vich\UploadableField(mapping="media", fileNameProperty="fileName")
     * @Assert\File(maxSize="16M")
     * @AppAssert\ProperMimeType
     */
    protected $file;

    /**
     * @return string
     */
    public function getFileName()
    {
        return $this->fileName;
    }

    /**
     * @param string $name
     */
    public function setFileName(string $name): void
    {
        $this->fileName = $name;
        if (property_exists($this, 'name') && !$this->name) {
            $this->name = $name;
        }
    }

    /**
     * @return string
     */
    public function getFileUrl()
    {
        return $this->fileUrl;
    }

    /**
     * @param $fileUrl
     */
    public function setFileUrl($fileUrl): void
    {
        $this->fileUrl = $fileUrl;
    }

    /**
     * @return $thumbnailUrl
     */
    public function getThumbnailUrl()
    {
        return $this->thumbnailUrl;
    }

    /**
     * @param $thumbnailUrl
     */
    public function setThumbnailUrl($thumbnailUrl): void
    {
        $this->thumbnailUrl = $thumbnailUrl;
    }

    /**
     * @return File|UploadedFile
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * @param File|null $file
     */
    public function setFile(File $file = null): void
    {
        $this->file = $file;
        if ($file) {
            $this->updatedAt = new \DateTime();
        }
    }

    /**
     * @return string
     */
    public function getMimeType(): string
    {
        return $this->file ? $this->file->getClientMimeType() : '';
    }

    /**
     * @return array
     */
    public function getAllowedMimeTypes(): array
    {
        /** @var Enum $enum */
        $enum = (new \ReflectionClass(static::class))->getConstant('ALLOWED_MIME_TYPES_ENUM');
        return $enum::getConstants();
    }
}

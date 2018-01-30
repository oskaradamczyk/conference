<?php
/**
 * Created by PhpStorm.
 * User: Oskar Adamczyk
 * Date: 28.08.17
 * Time: 11:26
 */

namespace AppBundle\Entity;

use AppBundle\Entity\Traits\UploadableTrait;
use AppBundle\Model\MimeTypeAwareInterface;
use AppBundle\Model\SeoAwareMediaInterface;
use AppBundle\Model\ThumbnailableMediaInterface;
use AppBundle\Model\UploadableMediaInterface;
use AppBundle\Util\ImageMediaAllowedMimeTypeEnum;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMS;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * Class Image
 * @package AppBundle\Entity
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 * @Vich\Uploadable
 * @JMS\ExclusionPolicy("all")
 */
class Image extends Media implements SeoAwareMediaInterface, MimeTypeAwareInterface, ThumbnailableMediaInterface
{
    const MEDIA_TYPE = 'image';
    const ALLOWED_MIME_TYPES_ENUM = ImageMediaAllowedMimeTypeEnum::class;

    use UploadableTrait;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     * @JMS\Expose()
     */
    protected $alt;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     * @JMS\Expose()
     */
    protected $title;

    /**
     * @return string
     */
    public function getAlt(): ?string
    {
        return $this->alt;
    }

    /**
     * @param string $alt
     * @return SeoAwareMediaInterface|Image
     */
    public function setAlt(string $alt): SeoAwareMediaInterface
    {
        $this->alt = $alt;
        return $this;
    }

    /**
     * @return string
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return SeoAwareMediaInterface|Image
     */
    public function setTitle(string $title): SeoAwareMediaInterface
    {
        $this->title = $title;
        return $this;
    }
}

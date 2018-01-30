<?php
/**
 * Created by PhpStorm.
 * User: Oskar Adamczyk
 * Date: 28.08.17
 * Time: 10:16
 */

namespace AppBundle\Entity;


use AppBundle\Entity\Traits\TimestampableTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMS;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * Class Media
 * @package AppBundle\Entity
 * @ORM\Entity
 * @ORM\EntityListeners({"AppBundle\Listener\EntityListener\MediaListener"})
 * @ORM\Embeddable
 * @ORM\InheritanceType("JOINED")
 * @ORM\HasLifecycleCallbacks
 * @ORM\DiscriminatorColumn(name="media_type", type="string")
 * @ORM\DiscriminatorMap({
 *     "image" = "Image",
 *     "html" = "Html",
 *     "pdf" = "Pdf",
 *     "survey" = "Survey"
 * })
 * @Vich\Uploadable
 * @JMS\ExclusionPolicy("all")
 * @JMS\Discriminator(disabled=true)
 */
abstract class Media extends AbstractModel
{
    use TimestampableTrait;

    /**
     * @var Collection
     *
     * @ORM\OneToMany(targetEntity="Slide", mappedBy="media")
     */
    protected $slides;

    /**
     * @var string
     *
     * @ORM\Column(type="text")
     */
    protected $type;

    /**
     * Media constructor.
     */
    public function __construct()
    {
        $this->type = (new \ReflectionClass(static::class))->getConstant('MEDIA_TYPE');
        $this->slides = new ArrayCollection();
    }

    /**
     * @return Collection
     */
    public function getSlides(): Collection
    {
        return $this->slides;
    }

    /**
     * @param Collection $slides
     * @return Media
     */
    public function setSlides(Collection $slides): self
    {
        $this->slides = $slides;
        return $this;
    }

    /**
     * @param Slide $slide
     * @return Media
     */
    public function addSlide(Slide $slide): self
    {
        if (!$this->slides->contains($slide)) {
            $this->slides->add($slide);
        }
        return $this;
    }

    /**
     * @param Slide $slide
     * @return Media
     */
    public function removeSlide(Slide $slide): self
    {
        if ($this->slides->contains($slide)) {
            $this->slides->removeElement($slide);
        }
        return $this;
    }

    /**
     * @return string
     */
    public function getType(): ?string
    {
        return $this->type;
    }

    /**
     * @param string $type
     * @return Media
     */
    public function setType(?string $type): Media
    {
        $this->type = $type;
        return $this;
    }
}

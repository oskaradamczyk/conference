<?php
/**
 * Created by PhpStorm.
 * User: Oskar Adamczyk
 * Date: 23.01.18
 * Time: 11:46
 */

namespace AppBundle\Entity;


use AppBundle\Entity\Traits\UploadableTrait;
use AppBundle\Model\MimeTypeAwareInterface;
use AppBundle\Model\UploadableMediaInterface;
use AppBundle\Util\PdfMediaAllowedMimeTypeEnum;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMS;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * Class Pdf
 * @package AppBundle\Entity
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 * @Vich\Uploadable
 * @JMS\ExclusionPolicy("all")
 */
class Pdf extends Media implements MimeTypeAwareInterface, UploadableMediaInterface
{
    const MEDIA_TYPE = 'pdf';
    const ALLOWED_MIME_TYPES_ENUM = PdfMediaAllowedMimeTypeEnum::class;

    use UploadableTrait;

    /**
     * @var Collection
     *
     * @ORM\ManyToMany(targetEntity="KnowledgeBase", mappedBy="medias")
     */
    protected $knowledgeBases;

    /**
     * @var Collection
     *
     * @ORM\ManyToMany(targetEntity="Guest", mappedBy="orders")
     */
    protected $guests;

    /**
     * Pdf constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->knowledgeBases = new ArrayCollection();
        $this->guests = new ArrayCollection();
    }

    /**
     * @return Collection
     */
    public function getKnowledgeBases(): Collection
    {
        return $this->knowledgeBases;
    }

    /**
     * @param Collection $knowledgeBases
     * @return Pdf
     */
    public function setKnowledgeBases(?Collection $knowledgeBases): Pdf
    {
        if (!$knowledgeBases) {
            $this->knowledgeBases = new ArrayCollection();
            return $this;
        }
        $this->knowledgeBases = $knowledgeBases;
        return $this;
    }

    /**
     * @param KnowledgeBase|null $knowledgeBase
     * @return Pdf
     */
    public function addKnowledgeBase(?KnowledgeBase $knowledgeBase): Pdf
    {
        $this->knowledgeBases->add($knowledgeBase);
        return $this;
    }

    /**
     * @param KnowledgeBase|null $knowledgeBase
     * @return Pdf
     */
    public function removeKnowledgeBase(?KnowledgeBase $knowledgeBase): Pdf
    {
        if ($this->knowledgeBases->contains($knowledgeBase)) {
            $this->knowledgeBases->removeElement($knowledgeBase);
        }
        return $this;
    }

    /**
     * @return Collection
     */
    public function getOrders(): Collection
    {
        return $this->guests;
    }

    /**
     * @param Collection $guests
     * @return Pdf
     */
    public function setOrders($guests): Pdf
    {
        $this->guests = $guests;
        return $this;
    }

    /**
     * @param Guest $guest
     * @return Pdf
     */
    public function addOrder(Guest $guest): Pdf
    {
        if (!$this->guests->contains($guest)) {
            $this->guests->add($guest);
        }
        return $this;
    }

    /**
     * @param Guest $guest
     * @return Pdf
     */
    public function removeOrder(Guest $guest): Pdf
    {
        if ($this->guests->contains($guest)) {
            $this->guests->removeElement($guest);
        }
        return $this;
    }
}

<?php
/**
 * Created by PhpStorm.
 * User: Oskar Adamczyk
 * Date: 23.01.18
 * Time: 11:25
 */

namespace AppBundle\Entity;


use AppBundle\Entity\Traits\TimestampableTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMS;

/**
 * Class KnowledgeBase
 * @package AppBundle\Entity
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 * @JMS\ExclusionPolicy("all")
 */
class KnowledgeBase extends AbstractModel
{
    use TimestampableTrait;

    /**
     * @var Collection
     *
     * @ORM\OneToMany(targetEntity="Section", mappedBy="knowledgeBase")
     */
    protected $sections;

    /**
     * @var Collection
     *
     * @ORM\ManyToMany(targetEntity="Pdf", inversedBy="knowledgeBases", cascade={"persist"})
     * @ORM\JoinTable(name="knowledge_bases_medias",
     *      joinColumns={@ORM\JoinColumn(name="knowledge_base_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="pdf_id", referencedColumnName="id")}
     * )
     * @JMS\Expose()
     */
    protected $medias;

    /**
     * KnowledgeBase constructor.
     */
    public function __construct()
    {
        $this->medias = new ArrayCollection();
        $this->sections = new ArrayCollection();
    }

    /**
     * @return Collection
     */
    public function getMedias(): Collection
    {
        return $this->medias;
    }

    /**
     * @param Collection $medias
     * @return KnowledgeBase
     */
    public function setMedias($medias): KnowledgeBase
    {
        if (!$medias) {
            $this->medias = new ArrayCollection();
            return $this;
        }
        $this->medias = $medias;
        return $this;
    }

    /**
     * @param Pdf|null $media
     * @return KnowledgeBase
     */
    public function addMedia($media): KnowledgeBase
    {
        $this->medias->add($media);
        return $this;
    }

    /**
     * @param Pdf|null $media
     * @return KnowledgeBase
     */
    public function removeMedia($media): KnowledgeBase
    {
        if ($this->medias->contains($media)) {
            $this->medias->removeElement($media);
        }
        return $this;
    }

    /**
     * @return Collection
     */
    public function getSections(): Collection
    {
        return $this->sections;
    }

    /**
     * @param Collection|null $sections
     * @return KnowledgeBase
     */
    public function setSections($sections): KnowledgeBase
    {
        if (!$sections) {
            $this->sections = new ArrayCollection();
            return $this;
        }
        $this->sections = $sections;
        return $this;
    }

    /**
     * @param Section $section
     * @return KnowledgeBase
     */
    public function addSection(Section $section): KnowledgeBase
    {
        $this->sections->add($section);
        return $this;
    }

    /**
     * @param Section $section
     * @return KnowledgeBase
     */
    public function removeSection(Section $section): KnowledgeBase
    {
        if ($this->sections->contains($section)) {
            $this->sections->removeElement($section);
        }
        return $this;
    }
}

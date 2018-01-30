<?php
/**
 * Created by PhpStorm.
 * User: Oskar Adamczyk
 * Date: 18.01.18
 * Time: 10:10
 */

namespace AppBundle\Entity;


use AppBundle\Entity\Traits\ActiveTrait;
use AppBundle\Entity\Traits\TimestampableTrait;
use AppBundle\Factory\SectionFactory;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMS;

/**
 * Class Section
 * @package AppBundle\Entity
 * @ORM\Entity(repositoryClass="AppBundle\Repository\SectionRepository")
 * @ORM\HasLifecycleCallbacks()
 * @JMS\ExclusionPolicy("all")
 */
class Section extends AbstractModel
{
    const FACTORY_CLASS_NAME = SectionFactory::class;

    use ActiveTrait,
        TimestampableTrait;
    
    /**
     * @var KnowledgeBase|null
     *
     * @ORM\ManyToOne(targetEntity="KnowledgeBase", inversedBy="section", cascade={"persist"})
     * @ORM\JoinColumn(name="knowledge_base_id", referencedColumnName="id", onDelete="SET NULL")
     * @JMS\Expose()
     */
    protected $knowledgeBase;
    
    /**
     * @var Collection
     *
     * @ORM\OneToMany(targetEntity="Lecture", mappedBy="section", cascade={"persist"})
     * @ORM\OrderBy({"startAt"="ASC"})
     * @JMS\Expose()
     */
    protected $lectures;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     * @JMS\Expose()
     */
    protected $agenda;

    /**
     * Section constructor.
     */
    public function __construct()
    {
        $this->lectures = new ArrayCollection();
    }

    /**
     * @return Collection
     */
    public function getLectures(): Collection
    {
        return $this->lectures;
    }

    /**
     * @param Collection|null $lectures
     * @return Section
     */
    public function setLectures($lectures): Section
    {
        if (!$lectures) {
            $this->lectures = new ArrayCollection();
            return $this;
        }
        $this->lectures = $lectures;
        return $this;
    }

    /**
     * @param Lecture $lecture
     * @return Section
     */
    public function addLecture(Lecture $lecture): Section
    {
        if (!$this->lectures->contains($lecture)) {
            $this->lectures->add($lecture);
        }
        return $this;
    }

    /**
     * @param Lecture $lecture
     * @return Section
     */
    public function removeLecture(Lecture $lecture): Section
    {
        if ($this->lectures->contains($lecture)) {
            $this->lectures->removeElement($lecture);
        }
        return $this;
    }

    /**
     * @return KnowledgeBase|null
     */
    public function getKnowledgeBase(): ?KnowledgeBase
    {
        return $this->knowledgeBase;
    }

    /**
     * @param KnowledgeBase|null $knowledgeBase
     * @return Section
     */
    public function setKnowledgeBase($knowledgeBase): Section
    {
        $this->knowledgeBase = $knowledgeBase;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getAgenda(): ?string
    {
        return $this->agenda;
    }

    /**
     * @param string $agenda
     * @return Section
     */
    public function setAgenda(string $agenda): Section
    {
        $this->agenda = $agenda;
        return $this;
    }
}

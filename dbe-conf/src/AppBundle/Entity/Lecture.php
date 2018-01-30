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
use AppBundle\Factory\LectureFactory;
use AppBundle\Validator\Constraints as AppAssert;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMS;

/**
 * Class Lecture
 * @package AppBundle\Entity
 * @ORM\Entity(repositoryClass="AppBundle\Repository\LectureRepository")
 * @ORM\EntityListeners({"AppBundle\Listener\EntityListener\LectureListener"})
 * @ORM\HasLifecycleCallbacks()
 * @AppAssert\LastIndeactivable(groups={"update"})
 * @JMS\ExclusionPolicy("all")
 */
class Lecture extends AbstractModel
{
    const FACTORY_CLASS_NAME = LectureFactory::class;

    use ActiveTrait,
        TimestampableTrait;

    /**
     * @var Section|null
     *
     * @ORM\ManyToOne(targetEntity="Section", inversedBy="lectures")
     * @ORM\JoinColumn(name="section_id", referencedColumnName="id", onDelete="SET NULL")
     */
    protected $section;

    /**
     * @var Collection
     *
     * @ORM\OneToMany(targetEntity="Slide", mappedBy="lecture", cascade={"persist"})
     * @ORM\OrderBy({"position"="ASC"})
     * @JMS\Expose()
     */
    protected $slides;

    /**
     * @var Collection
     *
     * @ORM\OneToMany(targetEntity="Question", mappedBy="lecture")
     */
    protected $questions;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="time")
     * @JMS\Expose()
     */
    protected $startAt;

    /**
     * Virtual field for dynamic listener counter
     *
     * @var int
     * @JMS\Expose()
     */
    protected $slideCount;

    /**
     * Lecture constructor.
     */
    public function __construct()
    {
        $this->slides = new ArrayCollection();
        $this->questions = new ArrayCollection();
        $this->startAt = new \DateTime();
    }

    /**
     * @return int
     */
    public function getSlideCount(): int
    {
        return $this->slideCount;
    }

    /**
     * @param int $slideCount
     * @return Lecture
     */
    public function setSlideCount(int $slideCount): self
    {
        $this->slideCount = $slideCount;
        return $this;
    }

    /**
     * @return Section|null
     */
    public function getSection(): ?Section
    {
        return $this->section;
    }

    /**
     * @param Section|null $section
     * @return Lecture
     */
    public function setSection($section): self
    {
        $this->section = $section;
        return $this;
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
     * @return Lecture
     */
    public function setSlides(Collection $slides): self
    {
        if (!$slides) {
            $this->slides = new ArrayCollection();
            return $this;
        }
        $this->slides = $slides;
        return $this;
    }

    /**
     * @param Slide $slide
     * @return Lecture
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
     * @return Lecture
     */
    public function removeSlide(Slide $slide): self
    {
        if ($this->slides->contains($slide)) {
            $this->slides->removeElement($slide);
        }
        return $this;
    }

    /**
     * @return Collection
     */
    public function getQuestions(): Collection
    {
        return $this->questions;
    }

    /**
     * @param Collection $questions
     * @return Lecture
     */
    public function setQuestions(Collection $questions): self
    {
        if (!$questions) {
            $this->questions = new ArrayCollection();
            return $this;
        }
        $this->questions = $questions;
        return $this;
    }

    /**
     * @param Question $question
     * @return Lecture
     */
    public function addQuestion(Question $question): self
    {
        if (!$this->questions->contains($question)) {
            $this->questions->add($question);
        }
        return $this;
    }

    /**
     * @param Question $question
     * @return Lecture
     */
    public function removeQuestion(Question $question): self
    {
        if ($this->questions->contains($question)) {
            $this->questions->removeElement($question);
        }
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getStartAt(): \DateTime
    {
        return $this->startAt;
    }

    /**
     * @param \DateTime $startAt
     * @return Lecture
     */
    public function setStartAt(\DateTime $startAt): self
    {
        $this->startAt = $startAt;
        return $this;
    }
}

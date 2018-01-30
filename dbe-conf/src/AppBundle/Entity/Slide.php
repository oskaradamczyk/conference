<?php
/**
 * Created by PhpStorm.
 * User: Oskar Adamczyk
 * Date: 18.01.18
 * Time: 10:10
 */

namespace AppBundle\Entity;


use AppBundle\Entity\Traits\ActiveTrait;
use AppBundle\Entity\Traits\FormAwareModelTrait;
use AppBundle\Entity\Traits\TimestampableTrait;
use AppBundle\Factory\SlideFactory;
use AppBundle\Form\SlideType;
use AppBundle\Model\FormAwareModelInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMS;

/**
 * Class Slide
 * @package AppBundle\Entity
 * @ORM\Entity(repositoryClass="AppBundle\Repository\SlideRepository")
 * @ORM\HasLifecycleCallbacks()
 * @JMS\ExclusionPolicy("all")
 */
class Slide extends AbstractModel implements FormAwareModelInterface
{
    const FACTORY_CLASS_NAME = SlideFactory::class;
    const FORM_CLASS_NAME = SlideType::class;

    use ActiveTrait,
        FormAwareModelTrait,
        TimestampableTrait;

    /**
     * @var Lecture
     *
     * @ORM\ManyToOne(targetEntity="Lecture", inversedBy="slides", cascade={"persist"})
     * @ORM\JoinColumn(name="lecture_id", referencedColumnName="id", onDelete="SET NULL")
     */
    protected $lecture;

    /**
     * @var Media|null
     *
     * @ORM\ManyToOne(targetEntity="Media", inversedBy="slides", cascade={"persist"})
     * @ORM\JoinColumn(name="media_id", referencedColumnName="id", onDelete="SET NULL")
     * @JMS\Expose()
     */
    protected $media;

    /**
     * @var Collection
     *
     * @ORM\OneToMany(targetEntity="Note", mappedBy="slide")
     */
    protected $notes;

    /**
     * @var Collection
     *
     * @ORM\OneToMany(targetEntity="Answer", mappedBy="slide")
     */
    protected $answers;

    /**
     * @var int|null
     *
     * @ORM\Column(type="integer")
     * @JMS\Expose()
     */
    protected $position = 0;

    /**
     * Slide constructor.
     */
    public function __construct()
    {
        $this->notes = new ArrayCollection();
        $this->answers = new ArrayCollection();
    }

    /**
     * @return null|string
     * @JMS\VirtualProperty()
     */
    public function getType()
    {
        return $this->media->getType();
    }

    /**
     * @return Lecture|null
     */
    public function getLecture(): ?Lecture
    {
        return $this->lecture;
    }

    /**
     * @param Lecture|null $lecture
     * @return Slide
     */
    public function setLecture($lecture): Slide
    {
        $this->lecture = $lecture;
        return $this;
    }

    /**
     * @return Media|null
     */
    public function getMedia(): ?Media
    {
        return $this->media;
    }

    /**
     * @param Media|null $media
     * @return Slide
     */
    public function setMedia($media): Slide
    {
        $this->media = $media;
        return $this;
    }

    /**
     * @return int
     */
    public function getPosition(): ?int
    {
        return $this->position;
    }

    /**
     * @param int $position
     * @return Slide
     */
    public function setPosition(int $position): Slide
    {
        $this->position = $position;
        return $this;
    }

    /**
     * @return Collection
     */
    public function getNotes(): Collection
    {
        return $this->notes;
    }

    /**
     * @param Collection|null $notes
     * @return Slide
     */
    public function setNotes($notes): Slide
    {
        if (!$notes) {
            $this->notes = new ArrayCollection();
        }
        $this->notes = $notes;
        return $this;
    }

    /**
     * @param Note $note
     * @return Slide
     */
    public function addNote(Note $note): Slide
    {
        if (!$this->notes->contains($note)) {
            $this->notes->add($note);
        }
        return $this;
    }

    /**
     * @param Note $note
     * @return Slide
     */
    public function removeNote(Note $note): Slide
    {
        if ($this->notes->contains($note)) {
            $this->notes->removeElement($note);
        }
        return $this;
    }

    /**
     * @return Collection
     */
    public function getAnswers(): Collection
    {
        return $this->answers;
    }

    /**
     * @param Collection|null $answers
     * @return Slide
     */
    public function setAnswers($answers): Slide
    {
        if (!$answers) {
            $this->answers = new ArrayCollection();
        }
        $this->answers = $answers;
        return $this;
    }

    /**
     * @param Answer $answer
     * @return Slide
     */
    public function addAnswer(Answer $answer): Slide
    {
        if (!$this->answers->contains($answer)) {
            $this->answers->add($answer);
        }
        return $this;
    }

    /**
     * @param Answer $answer
     * @return Slide
     */
    public function removeAnswer(Answer $answer): Slide
    {
        if ($this->answers->contains($answer)) {
            $this->answers->removeElement($answer);
        }
        return $this;
    }
}
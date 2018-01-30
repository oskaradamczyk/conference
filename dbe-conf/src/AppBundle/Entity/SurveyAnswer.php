<?php
/**
 * Created by PhpStorm.
 * User: Oskar Adamczyk
 * Date: 29.01.18
 * Time: 15:25
 */

namespace AppBundle\Entity;


use AppBundle\Entity\Traits\IdentityTrait;
use AppBundle\Entity\Traits\ModelFieldsAccessibleTrait;
use AppBundle\Factory\SurveyAnswerFactory;
use AppBundle\Form\SurveyAnswerType;
use AppBundle\Model\InitializeableModelInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMS;
use Symfony\Component\HttpFoundation\ParameterBag;

/**
 * Class SurveyAnswer
 * @package AppBundle\Entity
 * @ORM\Entity
 * @JMS\ExclusionPolicy("all")
 */
class SurveyAnswer implements InitializeableModelInterface
{
    const FACTORY_CLASS_NAME = SurveyAnswerFactory::class;
    const FORM_CLASS_NAME = SurveyAnswerType::class;

    use IdentityTrait,
        ModelFieldsAccessibleTrait;

    /**
     * @var Slide
     *
     * @ORM\ManyToOne(targetEntity="Slide", inversedBy="answers", cascade={"persist"})
     * @ORM\JoinColumn(name="slide_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $slide;

    /**
     * @var Guest
     *
     * @ORM\ManyToOne(targetEntity="Guest", inversedBy="answers", cascade={"persist"})
     * @ORM\JoinColumn(name="guest_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $guest;

    /**
     * @var Collection
     *
     * @ORM\OneToMany(targetEntity="Answer", mappedBy="surveyAnswer", cascade={"persist"})
     */
    private $answers;

    /**
     * SurveyAnswer constructor.
     */
    public function __construct()
    {
        $this->answers = new ArrayCollection();
    }

    /**
     * @param ParameterBag $args
     * @return InitializeableModelInterface
     */
    public static function init(ParameterBag $args): InitializeableModelInterface
    {
        $modelClass = static::class;
        return new $modelClass();
    }

    /**
     * @return string
     */
    public static function getFactoryClass(): string
    {
        return self::FACTORY_CLASS_NAME;
    }

    /**
     * @return Slide|null
     */
    public function getSlide(): ?Slide
    {
        return $this->slide;
    }

    /**
     * @param Slide|null $slide
     * @return SurveyAnswer
     */
    public function setSlide($slide): SurveyAnswer
    {
        $this->slide = $slide;
        return $this;
    }

    /**
     * @return Guest|null
     */
    public function getGuest(): ?Guest
    {
        return $this->guest;
    }

    /**
     * @param Guest|null $guest
     * @return SurveyAnswer
     */
    public function setGuest($guest): SurveyAnswer
    {
        $this->guest = $guest;
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
     * @return SurveyAnswer
     */
    public function setAnswers($answers): SurveyAnswer
    {
        if (!$answers) {
            $this->answers = new ArrayCollection();
        }
        $this->answers = $answers;
        return $this;
    }

    /**
     * @param Answer $answer
     * @return SurveyAnswer
     */
    public function addAnswer(Answer $answer): SurveyAnswer
    {
        if (!$this->answers->contains($answer)) {
            $this->answers->add($answer);
        }
        return $this;
    }

    /**
     * @param Answer $answer
     * @return SurveyAnswer
     */
    public function removeAnswer(Answer $answer): SurveyAnswer
    {
        if ($this->answers->contains($answer)) {
            $this->answers->removeElement($answer);
        }
        return $this;
    }
}

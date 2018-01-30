<?php
/**
 * Created by PhpStorm.
 * User: Oskar Adamczyk
 * Date: 28.01.18
 * Time: 19:25
 */

namespace AppBundle\Entity;


use AppBundle\Entity\Traits\IdentityTrait;
use AppBundle\Entity\Traits\TimestampableTrait;
use AppBundle\Util\Enum;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMS;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class SurveyQuestion
 * @package AppBundle\Entity
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 * @JMS\ExclusionPolicy("all")
 */
class SurveyQuestion extends AbstractModel
{
    const SINGLE_QUESTION_TYPE = 'single';

    use Enum,
        TimestampableTrait;

    /**
     * @var Collection
     *
     * @ORM\ManyToMany(targetEntity="PossibleAnswer", inversedBy="surveyQuestions", cascade={"persist"})
     * @ORM\JoinTable(name="survey_questions_possible_answers",
     *      joinColumns={@ORM\JoinColumn(name="survey_question_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="possible_answer_id", referencedColumnName="id")}
     * )
     * @JMS\Expose()
     */
    protected $possibleAnswers;

    /**
     * @var string
     *
     * @ORM\Column(type="text")
     * @Assert\NotBlank()
     * @JMS\Expose()
     */
    protected $content;

    /**
     * @var Collection
     *
     * @ORM\OneToMany(targetEntity="Answer", mappedBy="possibleAnswer")
     */
    private $answers;

    /**
     * @var string
     *
     * @ORM\Column(type="text")
     * @JMS\Expose()
     */
    protected $type;

    /**
     * SurveyQuestion constructor.
     */
    public function __construct()
    {
        $this->possibleAnswers = new ArrayCollection();
        $this->answers = new ArrayCollection();
    }

    /**
     * @return Collection
     */
    public function getPossibleAnswers(): Collection
    {
        return $this->possibleAnswers;
    }

    /**
     * @param Collection|null $possibleAnswers
     * @return SurveyQuestion
     */
    public function setPossibleAnswers($possibleAnswers): SurveyQuestion
    {
        if (!$possibleAnswers) {
            $this->possibleAnswers = new ArrayCollection();
            return $this;
        }
        $this->possibleAnswers = $possibleAnswers;
        return $this;
    }

    /**
     * @param PossibleAnswer $answer
     * @return SurveyQuestion
     */
    public function addPossibleAnswer(PossibleAnswer $answer): SurveyQuestion
    {
        if (!$this->possibleAnswers->contains($answer)) {
            $this->possibleAnswers->add($answer);
        }
        return $this;
    }

    /**
     * @param PossibleAnswer $answer
     * @return SurveyQuestion
     */
    public function removePossibleAnswer(PossibleAnswer $answer): SurveyQuestion
    {
        if ($this->possibleAnswers->contains($answer)) {
            $this->possibleAnswers->removeElement($answer);
        }
        return $this;
    }

    /**
     * @return string|null
     */
    public function getContent(): ?string
    {
        return $this->content;
    }

    /**
     * @param string|null $content
     * @return SurveyQuestion
     */
    public function setContent(?string $content): SurveyQuestion
    {
        $this->content = $content;
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
     * @param null|string $type
     * @return SurveyQuestion
     */
    public function setType(?string $type): SurveyQuestion
    {
        $this->type = $type;
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
     * @return SurveyQuestion
     */
    public function setAnswers($answers): SurveyQuestion
    {
        if (!$answers) {
            $this->answers = new ArrayCollection();
            return $this;
        }
        $this->answers = $answers;
        return $this;
    }

    /**
     * @param Answer $answer
     * @return SurveyQuestion
     */
    public function addAnswer(Answer $answer): SurveyQuestion
    {
        if (!$this->answers->contains($answer)) {
            $this->answers->add($answer);
        }
        return $this;
    }

    /**
     * @param Answer $answer
     * @return SurveyQuestion
     */
    public function removeAnswer(Answer $answer): SurveyQuestion
    {
        if ($this->answers->contains($answer)) {
            $this->answers->removeElement($answer);
        }
        return $this;
    }
}

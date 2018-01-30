<?php
/**
 * Created by PhpStorm.
 * User: Oskar Adamczyk
 * Date: 28.01.18
 * Time: 20:08
 */

namespace AppBundle\Entity;


use AppBundle\Entity\Traits\TimestampableTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMS;

/**
 * Class PossibleAnswer
 * @package AppBundle\Entity
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 * @JMS\ExclusionPolicy("all")
 */
class PossibleAnswer extends AbstractModel
{
    use TimestampableTrait;

    /**
     * @var Collection
     *
     * @ORM\ManyToMany(targetEntity="SurveyQuestion", mappedBy="possibleAnswers", cascade={"persist"})
     */
    private $surveyQuestions;

    /**
     * @var string
     *
     * @ORM\Column(type="text")
     * @JMS\Expose()
     */
    private $content;

    /**
     * @var Collection
     *
     * @ORM\OneToMany(targetEntity="Answer", mappedBy="possibleAnswer")
     */
    private $answers;

    public function __construct()
    {
        $this->answers = new ArrayCollection();
        $this->surveyQuestions = new ArrayCollection();
    }

    /**
     * @return Collection
     */
    public function getSurveys(): Collection
    {
        return $this->surveyQuestions;
    }

    /**
     * @param Collection|null $surveyQuestions
     * @return PossibleAnswer
     */
    public function setSurveyQuestions($surveyQuestions): PossibleAnswer
    {
        if (!$surveyQuestions) {
            $this->surveyQuestions = new ArrayCollection();
            return $this;
        }
        $this->surveyQuestions = $surveyQuestions;
        return $this;
    }

    /**
     * @param SurveyQuestion $surveyQuestion
     * @return PossibleAnswer
     */
    public function addSurvey(SurveyQuestion $surveyQuestion): PossibleAnswer
    {
        if (!$this->surveyQuestions->contains($surveyQuestion)) {
            $this->surveyQuestions->add($surveyQuestion);
        }
        return $this;
    }

    /**
     * @param SurveyQuestion $surveyQuestion
     * @return PossibleAnswer
     */
    public function removeSurvey(SurveyQuestion $surveyQuestion): PossibleAnswer
    {
        if ($this->surveyQuestions->contains($surveyQuestion)) {
            $this->surveyQuestions->removeElement($surveyQuestion);
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
     * @param string $content
     * @return PossibleAnswer
     */
    public function setContent(string $content): PossibleAnswer
    {
        $this->content = $content;
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
     * @return PossibleAnswer
     */
    public function setAnswers($answers): PossibleAnswer
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
     * @return PossibleAnswer
     */
    public function addAnswer(Answer $answer): PossibleAnswer
    {
        if (!$this->answers->contains($answer)) {
            $this->answers->add($answer);
        }
        return $this;
    }

    /**
     * @param Answer $answer
     * @return PossibleAnswer
     */
    public function removeAnswer(Answer $answer): PossibleAnswer
    {
        if ($this->answers->contains($answer)) {
            $this->answers->removeElement($answer);
        }
        return $this;
    }
}

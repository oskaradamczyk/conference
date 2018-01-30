<?php
/**
 * Created by PhpStorm.
 * User: Oskar Adamczyk
 * Date: 28.01.18
 * Time: 21:52
 */

namespace AppBundle\Entity;


use AppBundle\Entity\Traits\IdentityTrait;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMS;

/**
 * Class Answer
 * @package AppBundle\Entity
 * @ORM\Entity
 * @JMS\ExclusionPolicy("all")
 */
class Answer
{
    use IdentityTrait;

    /**
     * @var PossibleAnswer
     *
     * @ORM\ManyToOne(targetEntity="PossibleAnswer", inversedBy="answers", cascade={"persist"})
     * @ORM\JoinColumn(name="possible_answer_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $possibleAnswer;

    /**
     * @var SurveyAnswer
     *
     * @ORM\ManyToOne(targetEntity="SurveyAnswer", inversedBy="answers", cascade={"persist"})
     * @ORM\JoinColumn(name="survey_answer_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $surveyAnswer;

    /**
     * @var SurveyQuestion
     *
     * @ORM\ManyToOne(targetEntity="SurveyQuestion", inversedBy="answers", cascade={"persist"})
     * @ORM\JoinColumn(name="survey_question_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $question;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     */
    private $content;

    /**
     * @return SurveyAnswer
     */
    public function getSurveyAnswer(): ?SurveyAnswer
    {
        return $this->surveyAnswer;
    }

    /**
     * @param SurveyAnswer $surveyAnswer
     * @return Answer
     */
    public function setSurveyAnswer(SurveyAnswer $surveyAnswer): Answer
    {
        $this->surveyAnswer = $surveyAnswer;
        return $this;
    }

    /**
     * @return PossibleAnswer|null
     */
    public function getPossibleAnswer(): ?PossibleAnswer
    {
        return $this->possibleAnswer;
    }

    /**
     * @param PossibleAnswer|null $possibleAnswer
     * @return Answer
     */
    public function setPossibleAnswer($possibleAnswer): Answer
    {
        $this->possibleAnswer = $possibleAnswer;
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
     * @return Answer
     */
    public function setContent($content): Answer
    {
        $this->content = $content;
        return $this;
    }

    /**
     * @return SurveyQuestion|null
     */
    public function getQuestion(): ?SurveyQuestion
    {
        return $this->question;
    }

    /**
     * @param SurveyQuestion|null $question
     * @return Answer
     */
    public function setQuestion($question): Answer
    {
        $this->question = $question;
        return $this;
    }
}

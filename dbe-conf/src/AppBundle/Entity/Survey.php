<?php
/**
 * Created by PhpStorm.
 * User: Oskar Adamczyk
 * Date: 28.01.18
 * Time: 18:48
 */

namespace AppBundle\Entity;


use AppBundle\Model\InteractiveMediaInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMS;

/**
 * Class Survey
 * @package AppBundle\Entity
 * @ORM\Entity
 * @JMS\ExclusionPolicy("all")
 */
class Survey extends Media implements InteractiveMediaInterface
{
    const MEDIA_TYPE = 'survey';

    /**
     * @var Collection
     *
     * @ORM\ManyToMany(targetEntity="SurveyQuestion", inversedBy="surveys", cascade={"persist"})
     * @ORM\JoinTable(name="surveys_questions",
     *      joinColumns={@ORM\JoinColumn(name="survey_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="survey_question_id", referencedColumnName="id")}
     * )
     * @JMS\Expose()
     */
    protected $questions;

    /**
     * Survey constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->questions = new ArrayCollection();
    }

    /**
     * @return Collection
     */
    public function getQuestions(): Collection
    {
        return $this->questions;
    }

    /**
     * @param $questions
     * @return InteractiveMediaInterface
     */
    public function setQuestions($questions): InteractiveMediaInterface
    {
        if (!$questions) {
            $this->questions = new ArrayCollection();
            return $this;
        }
        $this->questions = $questions;
        return $this;
    }

    /**
     * @param SurveyQuestion $question
     * @return InteractiveMediaInterface
     */
    public function addQuestion(SurveyQuestion $question): InteractiveMediaInterface
    {
        if (!$this->questions->contains($question)) {
            $this->questions->add($question);
        }
        return $this;
    }

    /**
     * @param SurveyQuestion $question
     * @return InteractiveMediaInterface
     */
    public function removeQuestion(SurveyQuestion $question): InteractiveMediaInterface
    {
        if ($this->questions->contains($question)) {
            $this->questions->removeElement($question);
        }
        return $this;
    }
}

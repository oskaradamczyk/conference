<?php
/**
 * Created by PhpStorm.
 * User: Oskar Adamczyk
 * Date: 28.01.18
 * Time: 20:27
 */

namespace AppBundle\Model;


use AppBundle\Entity\SurveyQuestion;
use Doctrine\Common\Collections\Collection;

/**
 * Interface InteractiveMediaInterface
 * @package AppBundle\Model
 */
interface InteractiveMediaInterface
{
    /**
     * @return Collection
     */
    public function getQuestions(): Collection;
    /**
     * @param $questions
     * @return InteractiveMediaInterface
     */
    public function setQuestions($questions): InteractiveMediaInterface;

    /**
     * @param SurveyQuestion $question
     * @return InteractiveMediaInterface
     */
    public function addQuestion(SurveyQuestion $question): InteractiveMediaInterface;

    /**
     * @param SurveyQuestion $question
     * @return InteractiveMediaInterface
     */
    public function removeQuestion(SurveyQuestion $question): InteractiveMediaInterface;
}

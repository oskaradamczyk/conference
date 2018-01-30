<?php
/**
 * Created by PhpStorm.
 * User: Oskar Adamczyk
 * Date: 29.01.18
 * Time: 11:17
 */

namespace AppBundle\Handler;


use AppBundle\Entity\Answer;
use AppBundle\Entity\SurveyAnswer;
use AppBundle\Handler\Response\HandlerResponse;
use AppBundle\Service\SurveyAnswerService;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Validator\ConstraintViolationInterface;

/**
 * Class SurveyAnswerHandler
 * @package AppBundle\Handler
 */
class SurveyAnswerHandler extends AbstractHandler
{
    public function handle(FormInterface $form): HandlerResponse
    {
        /** @var SurveyAnswerService $saService */
        $saService = $this->service;
        $response = new HandlerResponse();
        if ($form->isSubmitted()) {
            $response->setSubmitted(true);
            if ($form->isValid()) {
                $response->setValid(true);
                /** @var SurveyAnswer $surveyAnswer */
                $surveyAnswer = $form->getData();
                /** @var Answer $answer */
                foreach ($surveyAnswer->getAnswers() as $answer) {
                    $answer->setSurveyAnswer($surveyAnswer);
                }
                $saService->save($surveyAnswer);
                $response->setAttributes([
                    'message' => $saService->translate(HandlerResponse::SUCCESS_MESSAGE)
                ]);
                return $response;
            }
            $response->setStatus(HandlerResponse::STATUS_ERROR);
            $error = $form->getErrors(true)->current();
            /** @var ConstraintViolationInterface $violation */
            $violation = $error->getCause();
            $response
                ->setStatus(HandlerResponse::STATUS_ERROR)
                ->setCode(HandlerResponse::CODE_ERROR)
                ->setAttributes([
                    'message' => $error->getMessage(),
                    'field' => $violation->getPropertyPath()
                ]);
            return $response;
        }
        $response
            ->setStatus(HandlerResponse::STATUS_ERROR)
            ->setCode(HandlerResponse::CODE_ERROR)
            ->setAttributes([
                'message' => $saService->translate(HandlerResponse::NOT_SUBMITTED_MESSAGE)
            ]);
        return $response;
    }
}

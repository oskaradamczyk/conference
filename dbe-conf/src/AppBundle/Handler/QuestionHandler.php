<?php
/**
 * Created by PhpStorm.
 * User: Oskar Adamczyk
 * Date: 11.01.18
 * Time: 10:46
 */

namespace AppBundle\Handler;


use AppBundle\Entity\Question;
use AppBundle\Handler\Response\HandlerResponse;
use AppBundle\Service\QuestionService;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Validator\ConstraintViolationInterface;

/**
 * Class QuestionHandler
 * @package AppBundle\Handler
 */
class QuestionHandler extends AbstractHandler
{
    /**
     * @param FormInterface $form
     * @return HandlerResponse
     */
    public function handle(FormInterface $form): HandlerResponse
    {
        /** @var QuestionService $qService */
        $qService = $this->service;
        $response = new HandlerResponse();
        if ($form->isSubmitted()) {
            $response->setSubmitted(true);
            if ($form->isValid()) {
                $response->setValid(true);
                /** @var Question $question */
                $question = $form->getData();
                $qService->save($question);
                $response->setAttributes([
                    'message' => $qService->translate(HandlerResponse::SUCCESS_MESSAGE)
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
                'message' => $qService->translate(HandlerResponse::NOT_SUBMITTED_MESSAGE)
            ]);
        return $response;
    }
}

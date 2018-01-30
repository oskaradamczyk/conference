<?php
/**
 * Created by PhpStorm.
 * User: Oskar Adamczyk
 * Date: 11.01.18
 * Time: 10:46
 */

namespace AppBundle\Handler;


use AppBundle\Handler\Response\HandlerResponse;
use AppBundle\Service\SlideService;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Validator\ConstraintViolationInterface;

/**
 * Class SlideHandler
 * @package AppBundle\Handler
 */
class SlideHandler extends AbstractHandler
{
    /**
     * @param FormInterface $form
     * @return HandlerResponse
     */
    public function handle(FormInterface $form): HandlerResponse
    {
        /** @var SlideService $slService */
        $slService = $this->service;
        $response = new HandlerResponse();
        if ($form->isSubmitted()) {
            $response->setSubmitted(true);
            if ($form->isValid()) {
                $response->setValid(true);
                $guest = $form->getData();
                $slService->save($guest);
                $response->setAttributes([
                    'message' => $slService->translate(HandlerResponse::SUCCESS_MESSAGE)
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
                'message' => $slService->translate(HandlerResponse::NOT_SUBMITTED_MESSAGE)
            ]);
        return $response;
    }
}

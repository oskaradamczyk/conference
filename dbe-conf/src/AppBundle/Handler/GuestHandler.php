<?php
/**
 * Created by PhpStorm.
 * User: Oskar Adamczyk
 * Date: 11.01.18
 * Time: 10:46
 */

namespace AppBundle\Handler;


use AppBundle\Entity\Guest;
use AppBundle\Handler\Response\HandlerResponse;
use AppBundle\Service\GuestService;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\ConstraintViolationInterface;

/**
 * Class GuestHandler
 * @package AppBundle\Handler
 */
class GuestHandler extends AbstractHandler
{
    /**
     * @param FormInterface $form
     * @return HandlerResponse
     */
    public function handle(FormInterface $form): HandlerResponse
    {
        /** @var GuestService $gService */
        $gService = $this->service;
        $response = new HandlerResponse();
        if ($form->isSubmitted()) {
            $response->setSubmitted(true);
            if ($form->isValid()) {
                $response->setValid(true);
                /** @var Guest $guest */
                $guest = $form->getData();
                if ($form->getConfig()->getMethod() === Request::METHOD_POST && $oldGuest = $this->service->getRepository()->findOneBy(['email' => $guest->getEmail()])) {
                    $response->setAttributes([
                        'message' => $gService->translate(HandlerResponse::SUCCESS_MESSAGE),
                        'guest' => $oldGuest
                    ]);
                    return $response;
                }
                $gService->save($guest);
                $response->setAttributes([
                    'message' => $gService->translate(HandlerResponse::SUCCESS_MESSAGE),
                    'guest' => $guest
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
                'message' => $gService->translate(HandlerResponse::NOT_SUBMITTED_MESSAGE)
            ]);
        return $response;
    }
}

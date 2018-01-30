<?php
/**
 * Created by PhpStorm.
 * User: Oskar Adamczyk
 * Date: 22.01.18
 * Time: 11:15
 */

namespace AppBundle\Handler;


use AppBundle\Handler\Response\HandlerResponse;
use Symfony\Component\Form\FormInterface;

/**
 * Interface AbstractHandlerInterface
 * @package AppBundle\Handler
 */
interface AbstractHandlerInterface
{
    /**
     * @param FormInterface $form
     * @return HandlerResponse
     */
    public function handle(FormInterface $form): HandlerResponse;
}

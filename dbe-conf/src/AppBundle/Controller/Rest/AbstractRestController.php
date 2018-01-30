<?php
/**
 * Created by PhpStorm.
 * User: Oskar Adamczyk
 * Date: 24.01.18
 * Time: 16:47
 */

namespace AppBundle\Controller\Rest;


use AppBundle\Handler\Response\HandlerResponse;
use AppBundle\Model\AbstractModelInterface;
use AppBundle\Model\FormAwareModelInterface;
use FOS\RestBundle\Controller\FOSRestController;
use JMS\Serializer\Serializer;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class AbstractRestController
 * @package AppBundle\Controller\Rest
 */
class AbstractRestController extends FOSRestController
{
    /**
     * @param HandlerResponse $response
     * @return Response
     */
    protected function getResponse(HandlerResponse $response): Response
    {
        /** @var Serializer $serializer */
        $serializer = $this->container->get('jms_serializer');
        if ($response->getCode() !== HandlerResponse::CODE_SUCCESS) {
            return new Response($serializer->serialize(['error' => $response], 'json'), $response->getCode());
        }
        return new Response($serializer->serialize($response, 'json'), $response->getCode());
    }

    /**
     * @param string $jsonContent
     * @param $class
     * @return FormInterface
     */
    protected function submitRestForm(string $jsonContent, $class): FormInterface
    {
        if(!($class instanceof AbstractModelInterface)){
            $class = new $class();
        }
        if ($class instanceof FormAwareModelInterface) {
            $form = $this->createForm($class->getFormClass(), $class);
            $data = json_decode($jsonContent, true);
            $form->submit($data);
            return $form;
        }
        throw new \InvalidArgumentException(sprintf('Model of class: "%s" is not aware of any form type.', get_class($class)));
    }
}

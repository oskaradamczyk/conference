<?php
/**
 * Created by PhpStorm.
 * User: Oskar Adamczyk
 * Date: 29.01.18
 * Time: 11:34
 */

namespace AppBundle\Controller\Rest;


use AppBundle\Factory\SurveyAnswerFactory;
use AppBundle\Form\SurveyAnswerType;
use AppBundle\Handler\SurveyAnswerHandler;
use FOS\RestBundle\Controller\Annotations as Rest;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class SurveyAnswerController
 * @package AppBundle\Controller\Rest
 */
class SurveyAnswerController extends AbstractRestController
{
    /**
     * @param Request $request
     * @return Response
     * @ApiDoc(
     *     description="Submits survey answers set for survey, returns response with message.",
     *     section="Answer",
     *     statusCodes = {
     *         200 = "Returned when successful",
     *         400 = "Returned when something went wrong"
     *     },
     *     input="AppBundle\Form\SurveyAnswerType",
     * )
     * @Rest\Post("/survey-answer")
     */
    public function postSurveyAnswerAction(Request $request)
    {
        /** @var SurveyAnswerFactory $saFactory */
        $saFactory = $this->get(SurveyAnswerFactory::class);
        /** @var SurveyAnswerHandler $saHandler */
        $saHandler = $saFactory->createHandler();
        return $this->getResponse($saHandler->handle($this->createForm(SurveyAnswerType::class)
            ->handleRequest($request)));
    }
}

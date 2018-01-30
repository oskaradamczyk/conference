<?php
/**
 * Created by PhpStorm.
 * User: Oskar Adamczyk
 * Date: 24.01.18
 * Time: 11:59
 */

namespace AppBundle\Controller\Rest;


use AppBundle\Entity\Question;
use AppBundle\Factory\QuestionFactory;
use AppBundle\Form\QuestionType;
use AppBundle\Handler\QuestionHandler;
use AppBundle\Model\AbstractModelInterface;
use AppBundle\Service\QuestionService;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Request\ParamFetcher;
use JMS\Serializer\Serializer;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Symfony\Component\HttpFoundation\ParameterBag;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class QuestionController
 * @package AppBundle\Controller\Rest
 */
class QuestionController extends AbstractRestController
{
    /**
     * @param Request $request
     * @return Response
     * @ApiDoc(
     *     description="Submits question, returns response with message.",
     *     section="Question",
     *     statusCodes = {
     *         200 = "Returned when successful",
     *         400 = "Returned when something went wrong"
     *     },
     *     input="AppBundle\Form\QuestionType",
     * )
     * @Rest\Post("/question")
     */
    public function postQuestionAction(Request $request)
    {
        /** @var QuestionFactory $qFactory */
        $qFactory = $this->get(QuestionFactory::class);
        /** @var QuestionHandler $qHandler */
        $qHandler = $qFactory->createHandler();
        return $this->getResponse($qHandler->handle($this->createForm(QuestionType::class)
            ->handleRequest($request)));
    }

    /**
     * @param Request $request
     * @param ParamFetcher $paramFetcher
     * @return Response
     * @ApiDoc(
     *     description="Changes existing question, mostly status case, returns response with message.",
     *     section="Question",
     *     statusCodes = {
     *         200 = "Returned when successful",
     *         400 = "Returned when something went wrong"
     *     },
     *     input="AppBundle\Form\QuestionType",
     * )
     * @Rest\Patch("/question")
     * @Rest\RequestParam(name="id", nullable=true)
     */
    public function patchQuestionAction(Request $request, ParamFetcher $paramFetcher)
    {
        /** @var QuestionFactory $qFactory */
        $qFactory = $this->get(QuestionFactory::class);
        /** @var QuestionService $qService */
        $qService = $qFactory->createService();
        /** @var QuestionHandler $qHandler */
        $qHandler = $qFactory->createHandler();
        /** @var AbstractModelInterface $question */
        $question = $qService->getRepository()->find($paramFetcher->get('id'));
        return $this->getResponse($qHandler->handle($this->createForm(QuestionType::class, $question, ['method' => Request::METHOD_PATCH])
            ->handleRequest($request)));
    }

    /**
     * @param ParamFetcher $paramFetcher
     * @return Response
     * @ApiDoc(
     *     description="Returns list of accepted questions.",
     *     section="Question",
     *     statusCodes = {
     *         200 = "Returned when successful"
     *     },
     * )
     * @Rest\Get("/question")
     * @Rest\QueryParam(name="lecture", nullable=true)
     * @Rest\QueryParam(name="section", nullable=true)
     */
    public function getQuestionAction(ParamFetcher $paramFetcher)
    {
        /** @var QuestionFactory $qFactory */
        $qFactory = $this->get(QuestionFactory::class);
        /** @var QuestionService $qService */
        $qService = $qFactory->createService();
        /** @var Serializer $serializer */
        $serializer = $this->container->get('jms_serializer');
        return new Response($serializer->serialize($qService->getFilteredDataSet(new ParameterBag([
            'lecture' => $paramFetcher->get('lecture'),
            'section' => $paramFetcher->get('section'),
            'accepted' => true,
            'answered' => false
        ]))->get('data'), 'json'));
    }
}

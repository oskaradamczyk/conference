<?php
/**
 * Created by PhpStorm.
 * User: Oskar Adamczyk
 * Date: 19.01.18
 * Time: 10:54
 */

namespace AppBundle\Controller\Rest;


use AppBundle\Factory\LectureFactory;
use AppBundle\Form\LectureType;
use AppBundle\Handler\LectureHandler;
use AppBundle\Model\AbstractModelInterface;
use AppBundle\Service\LectureService;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Request\ParamFetcher;
use JMS\Serializer\Serializer;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Symfony\Component\HttpFoundation\ParameterBag;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class LectureController
 * @package AppBundle\Controller\Rest
 */
class LectureController extends AbstractRestController
{
    /**
     * @param ParamFetcher $paramFetcher
     * @return Response
     * @ApiDoc(
     *     description="Returns active lecture for active section.",
     *     section="Lecture",
     *     statusCodes = {
     *         200 = "Returned when successful"
     *     },
     * )
     * @Rest\Get("/lecture")
     * @Rest\QueryParam(name="id", nullable=true)
     */
    public function getLectureAction(ParamFetcher $paramFetcher)
    {
        /** @var LectureFactory $lFactory */
        $lFactory = $this->get(LectureFactory::class);
        /** @var LectureService $lService */
        $lService = $lFactory->createService();
        /** @var Serializer $serializer */
        $serializer = $this->container->get('jms_serializer');
        return new Response($serializer->serialize($lService->getFilteredData(new ParameterBag([
            'active' => true,
            'id' => $paramFetcher->get('id')
        ]))->get('data'), 'json'));
    }

    /**
     * @param Request $request
     * @param ParamFetcher $paramFetcher
     * @return Response
     * @ApiDoc(
     *     description="Changes existing lecture, mostly status case, returns response with message.",
     *     section="Lecture",
     *     statusCodes = {
     *         200 = "Returned when successful",
     *         400 = "Returned when something went wrong"
     *     },
     *     input="AppBundle\Form\LectureType",
     * )
     * @Rest\Patch("/lecture")
     * @Rest\RequestParam(name="id")
     */
    public function patchLectureAction(Request $request, ParamFetcher $paramFetcher)
    {
        /** @var LectureFactory $lFactory */
        $lFactory = $this->get(LectureFactory::class);
        /** @var LectureService $lService */
        $lService = $lFactory->createService();
        /** @var LectureHandler $lHandler */
        $lHandler = $lFactory->createHandler();
        /** @var AbstractModelInterface $lecture */
        $lecture = $lService->getRepository()->find($paramFetcher->get('id'));
        return $this->getResponse($lHandler->handle($this->createForm(LectureType::class, $lecture, [
            'method' => Request::METHOD_PATCH,
            'validation_groups' => 'update'
        ])
            ->handleRequest($request)));
    }
}
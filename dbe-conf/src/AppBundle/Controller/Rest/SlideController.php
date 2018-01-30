<?php
/**
 * Created by PhpStorm.
 * User: Oskar Adamczyk
 * Date: 24.01.18
 * Time: 12:36
 */

namespace AppBundle\Controller\Rest;


use AppBundle\Factory\SlideFactory;
use AppBundle\Form\SlideType;
use AppBundle\Handler\SlideHandler;
use AppBundle\Model\AbstractModelInterface;
use AppBundle\Service\SlideService;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Request\ParamFetcher;
use JMS\Serializer\Serializer;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Symfony\Component\HttpFoundation\ParameterBag;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class SlideController extends AbstractRestController
{
    /**
     * @param Request $request
     * @param ParamFetcher $paramFetcher
     * @return Response
     * @ApiDoc(
     *     description="Changes existing slide, mostly status case, returns response with message.",
     *     section="Slide",
     *     statusCodes = {
     *         200 = "Returned when successful",
     *         400 = "Returned when something went wrong"
     *     },
     *     input="AppBundle\Form\SlideType",
     * )
     * @Rest\Patch("/slide")
     * @Rest\RequestParam(name="id")
     */
    public function patchSlideAction(Request $request, ParamFetcher $paramFetcher)
    {
        /** @var SlideFactory $slFactory */
        $slFactory = $this->get(SlideFactory::class);
        /** @var SlideService $slService */
        $slService = $slFactory->createService();
        /** @var SlideHandler $slHandler */
        $slHandler = $slFactory->createHandler();
        /** @var AbstractModelInterface $slide */
        $slide = $slService->getRepository()->find($paramFetcher->get('id'));
        return $this->getResponse($slHandler->handle($this->createForm(SlideType::class, $slide, ['method' => Request::METHOD_PATCH])
            ->handleRequest($request)));
    }
}

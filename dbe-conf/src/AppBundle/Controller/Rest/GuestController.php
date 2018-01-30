<?php
/**
 * Created by PhpStorm.
 * User: Oskar Adamczyk
 * Date: 24.01.18
 * Time: 11:59
 */

namespace AppBundle\Controller\Rest;


use AppBundle\Entity\Guest;
use AppBundle\Factory\GuestFactory;
use AppBundle\Form\GuestType;
use AppBundle\Handler\GuestHandler;
use AppBundle\Service\GuestService;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Request\ParamFetcher;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class GuestController
 * @package AppBundle\Controller\Rest
 */
class GuestController extends AbstractRestController
{
    /**
     * @param Request $request
     * @return Response
     * @ApiDoc(
     *     description="Submits guest, returns response with message and new guest id.",
     *     section="Guest",
     *     statusCodes = {
     *         200 = "Returned when successful",
     *         400 = "Returned when something went wrong"
     *     },
     *     input="AppBundle\Form\GuestType",
     * )
     * @Rest\Post("/guest")
     */
    public function postGuestAction(Request $request)
    {
        /** @var GuestFactory $gFactory */
        $gFactory = $this->get(GuestFactory::class);
        /** @var GuestHandler $gHandler */
        $gHandler = $gFactory->createHandler();
        return $this->getResponse($gHandler->handle($this->createForm(GuestType::class, null, ['validation_groups' => ['registration']])
            ->handleRequest($request)));
    }

    /**
     * @param Request $request
     * @param ParamFetcher $paramFetcher
     * @return Response
     * @ApiDoc(
     *     description="Submits guest orders for pdf documents, returns response with message.",
     *     section="Guest",
     *     statusCodes = {
     *         200 = "Returned when successful",
     *         400 = "Returned when something went wrong"
     *     },
     *     input="AppBundle\Form\GuestType",
     * )
     * @Rest\Patch("/guest")
     * @Rest\RequestParam(name="id", nullable=false)
     */
    public function patchGuestAction(Request $request, ParamFetcher $paramFetcher)
    {
        /** @var GuestFactory $gFactory */
        $gFactory = $this->get(GuestFactory::class);
        /** @var GuestService $gService */
        $gService = $gFactory->createService();
        /** @var GuestHandler $gHandler */
        $gHandler = $gFactory->createHandler();
        /** @var Guest $guest */
        $guest = $gService->getRepository()->find($paramFetcher->get('id'));
        return $this->getResponse($gHandler->handle($this->createForm(GuestType::class, $guest, ['method' => Request::METHOD_PATCH])
            ->handleRequest($request)));
    }
}

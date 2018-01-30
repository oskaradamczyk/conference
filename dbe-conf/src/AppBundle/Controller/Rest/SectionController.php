<?php
/**
 * Created by PhpStorm.
 * User: Oskar Adamczyk
 * Date: 19.01.18
 * Time: 10:54
 */

namespace AppBundle\Controller\Rest;


use AppBundle\Factory\LectureFactory;
use AppBundle\Factory\SectionFactory;
use AppBundle\Service\LectureService;
use AppBundle\Service\SectionService;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use JMS\Serializer\Serializer;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Symfony\Component\HttpFoundation\ParameterBag;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class LectureController
 * @package AppBundle\Controller\Rest
 */
class SectionController extends FOSRestController
{
    /**
     * @return Response
     * @ApiDoc(
     *     description="Returns active section.",
     *     section="Section",
     *     statusCodes = {
     *         200 = "Returned when successful"
     *     },
     * )
     * @Rest\Get("/section")
     */
    public function getSectionAction()
    {
        /** @var SectionFactory $sFactory */
        $sFactory = $this->get(SectionFactory::class);
        /** @var SectionService $sService */
        $sService = $sFactory->createService();
        /** @var Serializer $serializer */
        $serializer = $this->container->get('jms_serializer');
        return new Response($serializer->serialize($sService->getFilteredData(new ParameterBag(['active' => true]))->get('data'), 'json'));
    }
}
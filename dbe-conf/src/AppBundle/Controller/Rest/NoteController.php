<?php
/**
 * Created by PhpStorm.
 * User: Oskar Adamczyk
 * Date: 24.01.18
 * Time: 11:59
 */

namespace AppBundle\Controller\Rest;


use AppBundle\Factory\NoteFactory;
use AppBundle\Form\NoteType;
use AppBundle\Handler\NoteHandler;
use FOS\RestBundle\Controller\Annotations as Rest;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class NoteController
 * @package AppBundle\Controller\Rest
 */
class NoteController extends AbstractRestController
{
    /**
     * @param Request $request
     * @return Response
     * @ApiDoc(
     *     description="Submits note for user per slide, returns response with message.",
     *     section="Note",
     *     statusCodes = {
     *         200 = "Returned when successful",
     *         400 = "Returned when something went wrong"
     *     },
     *     input="AppBundle\Form\NoteType",
     * )
     * @Rest\Post("/note")
     */
    public function postNoteAction(Request $request)
    {
        /** @var NoteFactory $nFactory */
        $nFactory = $this->get(NoteFactory::class);
        /** @var NoteHandler $nHandler */
        $nHandler = $nFactory->createHandler();
        return $this->getResponse($nHandler->handle($this->createForm(NoteType::class)
            ->handleRequest($request)));
    }
}

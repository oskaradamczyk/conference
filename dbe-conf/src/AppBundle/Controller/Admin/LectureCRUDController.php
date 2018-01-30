<?php
/**
 * Created by PhpStorm.
 * User: Oskar Adamczyk
 * Date: 04.01.18
 * Time: 17:17
 */

namespace AppBundle\Controller\Admin;


use AppBundle\Factory\LectureFactory;
use AppBundle\Form\Type\LectureImportType;
use AppBundle\Handler\LectureHandler;
use Sonata\AdminBundle\Controller\CRUDController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class LectureCRUDController
 * @package AppBundle\Controller\Admin
 */
class LectureCRUDController extends CRUDController
{
    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function importAction(Request $request)
    {
        $this->admin->checkAccess('create');
        $form = $this->createForm(LectureImportType::class);
        $form->handleRequest($request);
        /** @var LectureFactory $lFactory */
        $lFactory = $this->get(LectureFactory::class);
        /** @var LectureHandler $lHandler */
        $lHandler = $lFactory->createHandler();
        $response = $lHandler->handle($form);
        $this->addFlash(
            sprintf('sonata_flash_%s', $response->getStatus()),
            $response->getAttributes()->get('message')
        );
        $redirect = new RedirectResponse(
            $this->admin->generateUrl('list', [
                'filter' => $this->admin->getFilterParameters()
            ])
        );
        return $redirect;
    }
}

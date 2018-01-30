<?php
/**
 * Created by PhpStorm.
 * User: Oskar Adamczyk
 * Date: 04.01.18
 * Time: 17:17
 */

namespace AppBundle\Controller\Admin;


use AppBundle\Entity\Slide;
use Sonata\AdminBundle\Controller\CRUDController;
use Sonata\AdminBundle\Datagrid\ProxyQueryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;

/**
 * Class SlideCRUDController
 * @package AppBundle\Controller\Admin
 */
class SlideCRUDController extends CRUDController
{
    /**
     * @param ProxyQueryInterface $selectedModelQuery
     * @return RedirectResponse
     */
    public function batchActionDeactivate(ProxyQueryInterface $selectedModelQuery)
    {
        $this->admin->checkAccess('edit');

        $modelManager = $this->admin->getModelManager();
        $selectedModels = $selectedModelQuery->execute();

        try {
            /** @var Slide $selectedModel */
            foreach ($selectedModels as $selectedModel) {
                if ($selectedModel->isActive()) {
                    $selectedModel->setActive(false);
                }
            }

            $modelManager->update($selectedModel);
        } catch (\Exception $e) {
            $this->addFlash('sonata_flash_error', $this->trans('admin.slide.deactivate_failure'));

            return new RedirectResponse(
                $this->admin->generateUrl('list', [
                    'filter' => $this->admin->getFilterParameters()
                ])
            );
        }

        $this->addFlash('sonata_flash_success', $this->trans('admin.slide.deactivate_success'));

        return new RedirectResponse(
            $this->admin->generateUrl('list', [
                'filter' => $this->admin->getFilterParameters()
            ])
        );
    }

    /**
     * @param ProxyQueryInterface $selectedModelQuery
     * @return RedirectResponse
     */
    public function batchActionActivate(ProxyQueryInterface $selectedModelQuery)
    {
        $this->admin->checkAccess('edit');

        $modelManager = $this->admin->getModelManager();
        $selectedModels = $selectedModelQuery->execute();

        try {
            /** @var Slide $selectedModel */
            foreach ($selectedModels as $selectedModel) {
                if (!$selectedModel->isActive()) {
                    $selectedModel->setActive(true);
                }
            }

            $modelManager->update($selectedModel);
        } catch (\Exception $e) {
            $this->addFlash('sonata_flash_error', $this->trans('admin.slide.activate_failure'));

            return new RedirectResponse(
                $this->admin->generateUrl('list', [
                    'filter' => $this->admin->getFilterParameters()
                ])
            );
        }

        $this->addFlash('sonata_flash_success', $this->trans('admin.slide.activate_success'));

        return new RedirectResponse(
            $this->admin->generateUrl('list', [
                'filter' => $this->admin->getFilterParameters()
            ])
        );
    }
}

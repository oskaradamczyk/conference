<?php
/**
 * Created by PhpStorm.
 * User: Oskar Adamczyk
 * Date: 28.08.17
 * Time: 14:02
 */

namespace AppBundle\Listener\EntityListener;

use AppBundle\Entity\Media;
use AppBundle\Model\ThumbnailableMediaInterface;
use AppBundle\Model\UploadableMediaInterface;
use Doctrine\ORM\Mapping as ORM;
use Liip\ImagineBundle\Controller\ImagineController;
use Liip\ImagineBundle\DependencyInjection\LiipImagineExtension;
use Liip\ImagineBundle\Imagine\Cache\CacheManager;
use Symfony\Component\HttpFoundation\RequestStack;
use Vich\UploaderBundle\Templating\Helper\UploaderHelper;

class MediaListener
{
    /** @var  UploaderHelper */
    protected $uploaderHelper;

    /** @var  RequestStack */
    protected $requestStack;

    /** @var  ImagineController */
    protected $imagineController;

    /** @var  CacheManager */
    protected $cacheManager;

    public function __construct(RequestStack $requestStack, UploaderHelper $uploaderHelper, ImagineController $imagineController, CacheManager $cacheManager)
    {
        $this->uploaderHelper = $uploaderHelper;
        $this->requestStack = $requestStack;
        $this->imagineController = $imagineController;
        $this->cacheManager = $cacheManager;
    }

    /**
     * @ORM\PostLoad()
     *
     * @param Media $media
     */
    public function postLoadHandler(Media $media)
    {
        if (($request = $this->requestStack->getCurrentRequest()) && $media instanceof UploadableMediaInterface) {
            $request = $this->requestStack->getCurrentRequest();
            $media->setFileUrl(
                $request->getSchemeAndHttpHost() .
                $relativePath = $this->uploaderHelper->asset($media, 'file')
            );
            if ($media instanceof ThumbnailableMediaInterface) {
                $this->imagineController->filterAction(
                    $request,
                    $relativePath,
                    'thumb'
                );
                $media->setThumbnailUrl(
                    $this->cacheManager->getBrowserPath(
                        $relativePath,
                        'thumb'
                    )
                );
            }
        }
    }
}
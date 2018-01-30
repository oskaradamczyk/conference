<?php
/**
 * Created by PhpStorm.
 * User: Oskar Adamczyk
 * Date: 28.08.17
 * Time: 14:02
 */

namespace AppBundle\Listener\EntityListener;

use AppBundle\Entity\Lecture;
use AppBundle\Factory\SlideFactory;
use AppBundle\Repository\SlideRepository;
use AppBundle\Service\SlideService;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\ParameterBag;

class LectureListener
{
    /** @var SlideFactory */
    protected $sFactory;

    public function __construct(SlideFactory $sFactory)
    {
        $this->sFactory = $sFactory;
    }

    /**
     * @ORM\PostLoad()
     *
     * @param Lecture $lecture
     */
    public function postLoadHandler(Lecture $lecture)
    {
        /** @var SlideService $sService */
        $sService = $this->sFactory->createService();
        /** @var SlideRepository $sRepo */
        $sRepo = $sService->getRepository();
        $lecture->setSlideCount($sRepo->getDecoratedResult(new ParameterBag([
            'lecture' => $lecture
        ])));
    }
}
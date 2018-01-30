<?php
/**
 * Created by PhpStorm.
 * User: Oskar Adamczyk
 * Date: 19.01.18
 * Time: 11:18
 */

namespace AppBundle\Service;


use AppBundle\Entity\Image;
use AppBundle\Entity\Lecture;
use AppBundle\Entity\Slide;
use AppBundle\Model\AbstractModelInterface;
use AppBundle\Repository\LectureRepository;
use AppBundle\Service\Traits\TranslationAwareServiceTrait;
use AppBundle\Service\Traits\ValidationAwareServiceTrait;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Finder\Finder;
use Symfony\Component\HttpFoundation\ParameterBag;
use Symfony\Component\Translation\TranslatorInterface;
use Symfony\Component\Validator\ConstraintViolationListInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * Class LectureService
 * @package AppBundle\Service
 */
class LectureService extends AbstractService implements ValidationAwareInterface, TranslationAwareInterface
{
    use TranslationAwareServiceTrait,
        ValidationAwareServiceTrait;

    public function __construct(
        EntityManagerInterface $em,
        EventDispatcherInterface $eventDispatcher,
        $modelClassName,
        ValidatorInterface $validator,
        TranslatorInterface $translator
    )
    {
        parent::__construct($em, $eventDispatcher, $modelClassName);
        $this->setValidator($validator);
        $this->setTranslator($translator);
    }

    /**
     * @param Finder $finder
     * @return Lecture
     */
    public function createLectureFromArchive(Finder $finder): Lecture
    {
        $lecture = new Lecture();
        $position = 0;
        foreach ($finder as $file) {
            $slide = new Slide();
            $image = new Image();
            $fileName = $file->getFilename();
            $image
                ->setTitle($fileName)
                ->setAlt($fileName)
                ->setFileName($fileName);
            if($position === 0){
                $slide->setActive(true);
            }
            $slide
                ->setPosition(++$position)
                ->setLecture($lecture)
                ->setMedia($image)
                ->setName($file->getFilename());
            $lecture->addSlide($slide);
        }
        return $lecture;
    }
}

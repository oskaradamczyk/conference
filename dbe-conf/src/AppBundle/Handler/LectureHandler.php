<?php
/**
 * Created by PhpStorm.
 * User: Oskar Adamczyk
 * Date: 11.01.18
 * Time: 10:46
 */

namespace AppBundle\Handler;


use AppBundle\Entity\Lecture;
use AppBundle\Entity\Section;
use AppBundle\Handler\Response\HandlerResponse;
use AppBundle\Handler\Traits\UploadableHandlerTrait;
use AppBundle\Model\LectureImport;
use AppBundle\Model\Uploadable;
use AppBundle\Service\AbstractServiceInterface;
use AppBundle\Service\LectureService;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Form\Exception\LogicException;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\ParameterBag;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\ConstraintViolationInterface;

/**
 * Class LectureHandler
 * @package AppBundle\Handler
 */
class LectureHandler extends AbstractHandler implements UploadableHandlerInterface
{
    use UploadableHandlerTrait;

    const LECTURE_SUCCESS_MESSAGE = 'admin.lecture.success';

    /** @var Finder */
    private $finder;

    /**
     * LectureHandler constructor.
     * @param AbstractServiceInterface $service
     * @param string|null $archiveTempDir
     * @param string|null $uploadDir
     */
    public function __construct(AbstractServiceInterface $service, string $archiveTempDir = null, string $uploadDir = null)
    {
        parent::__construct($service);
        $this->archiveTempDir = $archiveTempDir;
        $this->uploadDir = $uploadDir;
        $this->fs = new Filesystem();
    }

    /**
     * @param FormInterface $form
     * @return HandlerResponse
     */
    public function handle(FormInterface $form): HandlerResponse
    {
        /** @var LectureService $lService */
        $lService = $this->service;
        $response = new HandlerResponse();
        if ($form->isSubmitted()) {
            $response->setSubmitted(true);
            if ($form->isValid()) {
                $response->setValid(true);
                if ($form->getData() instanceof Uploadable) {
                    /** @var LectureImport $lImport */
                    $lImport = $form->getData();
                    $this->unpackZip($lImport->getFile()->getRealPath());
                    $this->finder = new Finder();
                    $this->finder->in($this->archiveTempDir)->files()->sortByName();
                    foreach ($this->finder as $file) {
                        $this->fs->copy($file->getRealPath(), $this->uploadDir . '//' . $file->getFilename());
                    }
                    $lecture = $lService->createLectureFromArchive($this->finder);
                    $this->clearTempDir();
                    $this->finder->in($this->uploadDir)->files()->depth(0);
                    $lecture->setName($lImport->getLectureName());
                    $errors = $lService->validate($lecture);
                    if ($errors->count() === 0) {
                        $lService->save($lecture);
                        $response
                            ->setStatus(HandlerResponse::STATUS_SUCCESS)
                            ->setAttributes([
                                'message' => $lService->translate(self::LECTURE_SUCCESS_MESSAGE)
                            ]);
                        return $response;
                    }
                }
                $lecture = $form->getData();
                $isActivating = $lecture->isActive();
                $lService->save($lecture);
                if ($form->getConfig()->getMethod() === Request::METHOD_PATCH && !$isActivating) {
                    /** @var Section $section */
                    $section = $lecture->getSection();
                    /** @var Lecture $lecture */
                    $lecture = $section->getLectures()->get($section->getLectures()->indexOf($lecture) + 1)->setActive(true);
                    $lecture->getSlides()->first()->setActive(true);
                    $lService->save($lecture);
                    $response
                        ->setStatus(HandlerResponse::STATUS_SUCCESS)
                        ->setAttributes([
                            'message' => $lService->translate(HandlerResponse::SUCCESS_MESSAGE),
                            'lecture' => $lecture
                        ]);
                    return $response;
                }
                $response->setAttributes([
                    'message' => $lService->translate(HandlerResponse::SUCCESS_MESSAGE)
                ]);
                return $response;
            }
            $error = $form->getErrors(true)->current();
            /** @var ConstraintViolationInterface $violation */
            $violation = $error->getCause();
            $response
                ->setStatus(HandlerResponse::STATUS_ERROR)
                ->setCode(HandlerResponse::CODE_ERROR)
                ->setAttributes([
                    'message' => $lService->translate($error->getMessageTemplate(), $error->getMessageParameters()),
                    'field' => $violation->getPropertyPath()
                ]);
            return $response;
        }
        $response
            ->setStatus(HandlerResponse::STATUS_ERROR)
            ->setCode(HandlerResponse::CODE_ERROR)
            ->setAttributes([
                'message' => $lService->translate(HandlerResponse::NOT_SUBMITTED_MESSAGE)
            ]);
        return $response;
    }

    /**
     * @param string $realPath
     */
    private function unpackZip(string $realPath)
    {
        $zip = new \ZipArchive();
        if ($zip->open($realPath) === true) {
            $this->initTempDir();
            $zip->extractTo($this->archiveTempDir);
            $zip->close();
        }
    }
}

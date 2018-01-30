<?php
/**
 * Created by PhpStorm.
 * User: Oskar Adamczyk
 * Date: 18.01.18
 * Time: 14:35
 */

namespace AppBundle\Factory;


use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Translation\TranslatorInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * Class AbstractFactory
 * @package AppBundle\Factory
 */
abstract class AbstractFactory implements AbstractFactoryInterface
{
    /** @var EntityManagerInterface */
    protected $em;

    /** @var EventDispatcherInterface */
    protected $eventDispatcher;

    /** @var ValidatorInterface */
    protected $validator;

    /** @var TranslatorInterface */
    protected $translator;

    /** @var LoggerInterface */
     protected $logger;

    /** @var string */
     protected $modelClassName;

    /** @var string */
     protected $archiveTempDir;

    /** @var string */
     protected $uploadDir;

    /**
     * AbstractFactory constructor.
     * @param EntityManagerInterface $em
     * @param EventDispatcherInterface $eventDispatcher
     * @param TranslatorInterface $translator
     * @param ValidatorInterface $validator
     * @param LoggerInterface $logger
     * @param string $modelClassName
     * @param string $archiveTempDir
     * @param string $uploadDir
     */
    public function __construct(
        EntityManagerInterface $em,
        EventDispatcherInterface $eventDispatcher,
        TranslatorInterface $translator,
        ValidatorInterface $validator,
        LoggerInterface $logger,
        string $modelClassName,
        string $archiveTempDir,
        string $uploadDir
    )
    {
        $this->em = $em;
        $this->eventDispatcher = $eventDispatcher;
        $this->translator = $translator;
        $this->validator = $validator;
        $this->logger = $logger;
        $this->modelClassName = $modelClassName;
        $this->archiveTempDir = $archiveTempDir;
        $this->uploadDir = $uploadDir;
    }
}

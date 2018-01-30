<?php
/**
 * Created by PhpStorm.
 * User: Oskar Adamczyk
 * Date: 18.01.18
 * Time: 14:35
 */

namespace AppBundle\Factory;


use AppBundle\Model\AbstractModelInterface;
use AppBundle\Util\Enum;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\MappingException;
use Psr\Log\LoggerInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Translation\TranslatorInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * Class SuperFactory
 * @package AppBundle\Factory
 */
final class SuperFactory
{
    use Enum;

    const LECTURE_FACTORY_TYPE = 'lecture';
    const SLIDE_FACTORY_TYPE = 'slide';
    const SECTION_FACTORY_TYPE = 'section';

    /** @var EntityManagerInterface */
    private static $em;

    /** @var EventDispatcherInterface */
    private static $eventDispatcher;

    /** @var TranslatorInterface */
    private static $translator;

    /** @var ValidatorInterface */
    private static $validator;

    /** @var LoggerInterface */
    private static $logger;

    /** @var string */
    private static $archiveTempDir;

    /** @var string */
    private static $uploadDir;

    /**
     * SuperFactory constructor.
     * @param TranslatorInterface $translator
     * @param ValidatorInterface $validator
     * @param EntityManagerInterface $em
     * @param EventDispatcherInterface $eventDispatcher
     * @param LoggerInterface $logger
     * @param RequestStack $requestStack
     * @param string $archiveTempDir
     * @param string $uploadDir
     */
    public function __construct(
        TranslatorInterface $translator,
        ValidatorInterface $validator,
        EntityManagerInterface $em,
        EventDispatcherInterface $eventDispatcher,
        LoggerInterface $logger,
        RequestStack $requestStack,
        string $archiveTempDir,
        string $uploadDir
    )
    {
        self::$em = $em;
        self::$eventDispatcher = $eventDispatcher;
        self::$translator = $translator;
        self::$validator = $validator;
        self::$logger = $logger;
        self::$archiveTempDir = $archiveTempDir;
        self::$uploadDir = $uploadDir;
    }

    /**
     * @param string $modelClassName
     * @return AbstractFactoryInterface
     * @throws MappingException
     */
    public static function createFactory(string $modelClassName): AbstractFactoryInterface
    {
        $model = new $modelClassName;
        if (class_exists($modelClassName) && ($model instanceof AbstractModelInterface)) {
            $factoryClass = $modelClassName::getFactoryClass();
            $factory = new $factoryClass(self::$em, self::$eventDispatcher, self::$translator, self::$validator, self::$logger, $modelClassName, self::$archiveTempDir, self::$uploadDir);
            return $factory;
        }
        throw new MappingException(sprintf('Model class "%s" is not mapped.', ucfirst($modelClassName)));
    }
}

<?php
/**
 * Created by PhpStorm.
 * User: Oskar Adamczyk
 * Date: 19.01.18
 * Time: 14:54
 */

namespace AppBundle\Service;


use AppBundle\Decorator\QBDecoratorInterface;
use AppBundle\Service\Traits\TranslationAwareServiceTrait;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Translation\TranslatorInterface;

/**
 * Class SlideService
 * @package AppBundle\Service
 */
class SlideService extends AbstractService implements TranslationAwareInterface, RepositoryInitializedServiceInterface
{
    use TranslationAwareServiceTrait;

    /**
     * SlideService constructor.
     * @param EntityManagerInterface $em
     * @param EventDispatcherInterface $eventDispatcher
     * @param string $modelClassName
     * @param TranslatorInterface $translator
     */
    public function __construct(EntityManagerInterface $em, EventDispatcherInterface $eventDispatcher, $modelClassName, TranslatorInterface $translator)
    {
        parent::__construct($em, $eventDispatcher, $modelClassName);
        $this->setTranslator($translator);
    }

    /**
     * @param QBDecoratorInterface $decorator
     */
    public function initializeRepository(QBDecoratorInterface $decorator): void
    {
        $this->getRepository()->setDecorator($decorator);
    }
}

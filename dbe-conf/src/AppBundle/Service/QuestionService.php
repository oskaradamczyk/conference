<?php
/**
 * Created by PhpStorm.
 * User: Oskar Adamczyk
 * Date: 24.01.18
 * Time: 12:18
 */

namespace AppBundle\Service;


use AppBundle\Service\Traits\TranslationAwareServiceTrait;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Translation\TranslatorInterface;

/**
 * Class QuestionService
 * @package AppBundle\Service
 */
class QuestionService extends AbstractService implements TranslationAwareInterface
{
    use TranslationAwareServiceTrait;

    /**
     * QuestionService constructor.
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
}

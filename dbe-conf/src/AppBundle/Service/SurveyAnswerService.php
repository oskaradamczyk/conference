<?php
/**
 * Created by PhpStorm.
 * User: Oskar Adamczyk
 * Date: 25.01.18
 * Time: 10:22
 */

namespace AppBundle\Service;


use AppBundle\Service\Traits\TranslationAwareServiceTrait;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Translation\TranslatorInterface;

/**
 * Class SurveyAnswerService
 * @package AppBundle\Service
 */
class SurveyAnswerService extends AbstractService implements TranslationAwareInterface
{
    use TranslationAwareServiceTrait;

    /**
     * AnswerService constructor.
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

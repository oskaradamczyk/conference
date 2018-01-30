<?php
/**
 * Created by PhpStorm.
 * User: Oskar Adamczyk
 * Date: 24.01.18
 * Time: 12:20
 */

namespace AppBundle\Service;


use Symfony\Component\Translation\TranslatorInterface;

/**
 * Interface TranslationAwareInterface
 * @package AppBundle\Service
 */
interface TranslationAwareInterface
{
    /**
     * @param TranslatorInterface $translator
     */
    public function setTranslator(TranslatorInterface $translator): void;

    /**
     * @param string $message
     * @param array $parameters
     * @param string|null $domain
     * @param string|null $locale
     * @return string
     */
    public function translate(string $message, array $parameters = [], string $domain = null, string $locale = null): string;
}

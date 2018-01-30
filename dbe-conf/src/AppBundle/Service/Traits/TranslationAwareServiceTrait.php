<?php
/**
 * Created by PhpStorm.
 * User: Oskar Adamczyk
 * Date: 24.01.18
 * Time: 12:24
 */

namespace AppBundle\Service\Traits;


use Symfony\Component\Translation\TranslatorInterface;

/**
 * Trait TranslationAwareServiceTrait
 * @package AppBundle\Service\Traits
 */
trait TranslationAwareServiceTrait
{
    /** @var TranslatorInterface */
    protected $translator;

    /**
     * @param TranslatorInterface $translator
     */
    public function setTranslator(TranslatorInterface $translator): void
    {
        $this->translator = $translator;
    }

    /**
     * @param string $message
     * @param array $parameters
     * @param string|null $domain
     * @param string|null $locale
     * @return string
     */
    public function translate(string $message, array $parameters = [], string $domain = null, string $locale = null): string
    {
        return $this->translator->trans($message, $parameters, $domain, $locale);
    }
}

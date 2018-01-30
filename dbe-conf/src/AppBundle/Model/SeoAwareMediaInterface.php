<?php
/**
 * Created by PhpStorm.
 * User: Oskar Adamczyk
 * Date: 18.01.18
 * Time: 13:18
 */

namespace AppBundle\Model;


/**
 * Interface SeoAwareInterface
 * @package AppBundle\Model
 */
interface SeoAwareMediaInterface
{
    /**
     * @param string $title
     * @return SeoAwareMediaInterface
     */
    public function setTitle(string $title): SeoAwareMediaInterface;

    /**
     * @return string
     */
    public function getTitle(): ?string;

    /**
     * @param string $alt
     * @return SeoAwareMediaInterface
     */
    public function setAlt(string $alt): SeoAwareMediaInterface;

    /**
     * @return string
     */
    public function getAlt(): ?string;
}
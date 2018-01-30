<?php
/**
 * Created by PhpStorm.
 * User: Oskar Adamczyk
 * Date: 24.01.18
 * Time: 14:16
 */

namespace AppBundle\Model;


/**
 * Interface NameableModelInterface
 * @package AppBundle\Model
 */
interface NameableModelInterface
{
    /**
     * @return string
     */
    public function __toString(): string;

    /**
     * @return null|string
     */
    public function getName(): ?string;

    /**
     * @param $name
     * @return NameableModelInterface
     */
    public function setName($name): NameableModelInterface;
}

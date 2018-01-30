<?php
/**
 * Created by PhpStorm.
 * User: Oskar Adamczyk
 * Date: 23.01.18
 * Time: 15:57
 */

namespace AppBundle\Model;


/**
 * Interface AbstractModelInterface
 * @package AppBundle\Model
 */
interface AbstractModelInterface
{
    /**
     * @return string
     */
    public static function getFactoryClass(): string;

    /**
     * @return array
     */
    public function getModelFields(): array;

    /**
     * @return int|null
     */
    public function getId(): ?int;

    /**
     * @param int $id
     * @return AbstractModelInterface
     */
    public function setId(int $id): AbstractModelInterface;
}

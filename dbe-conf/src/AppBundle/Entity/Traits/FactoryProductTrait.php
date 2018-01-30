<?php
/**
 * Created by PhpStorm.
 * User: Oskar Adamczyk
 * Date: 25.01.18
 * Time: 09:33
 */

namespace AppBundle\Entity\Traits;


/**
 * Trait FactoryProductTrait
 * @package AppBundle\Entity\Traits
 */
trait FactoryProductTrait
{
    /**
     * @return string
     */
    public static function getFactoryClass(): string
    {
        return (new \ReflectionClass(static::class))->getConstant('FACTORY_CLASS_NAME');
    }
}

<?php
/**
 * Created by PhpStorm.
 * User: Oskar Adamczyk
 * Date: 18.01.18
 * Time: 14:35
 */

namespace AppBundle\Util;

trait Enum
{
    /**
     * @return array
     */
    public static function getConstants(): array
    {
        return (new \ReflectionClass(static::class))->getConstants();
    }

    /**
     * @return array
     */
    public static function getMap(): array
    {
        return array_flip(self::getConstants());
    }
}

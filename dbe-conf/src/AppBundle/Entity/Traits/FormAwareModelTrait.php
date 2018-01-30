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
trait FormAwareModelTrait
{
    /**
     * @return string
     */
    public function getFormClass(): string
    {
        return (new \ReflectionClass(static::class))->getConstant('FORM_CLASS_NAME');
    }
}

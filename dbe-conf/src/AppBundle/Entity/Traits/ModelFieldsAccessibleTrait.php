<?php
/**
 * Created by PhpStorm.
 * User: Oskar Adamczyk
 * Date: 24.01.18
 * Time: 14:21
 */

namespace AppBundle\Entity\Traits;


/**
 * Trait ModelFieldsAccessibleTrait
 * @package AppBundle\Entity\Traits
 */
trait ModelFieldsAccessibleTrait
{
    /**
     * @return array
     */
    public function getModelFields(): array
    {
        return get_object_vars($this);
    }
}

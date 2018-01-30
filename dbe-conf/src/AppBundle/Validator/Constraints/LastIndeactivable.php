<?php
/**
 * Created by PhpStorm.
 * User: Oskar Adamczyk
 * Date: 07.09.17
 * Time: 14:08
 */

namespace AppBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * Class LastIndezactivable
 * @package AppBundle\Validator\Constraints
 * @Annotation
 */
class LastIndeactivable extends Constraint
{
    public $message = 'admin.lecture.last_indeactivable';

    /**
     * @return string
     */
    public function getTargets()
    {
        return self::CLASS_CONSTRAINT;
    }
}
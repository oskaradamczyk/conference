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
 * Class ProperMimeType
 * @package AppBundle\Validator\Constraints
 * @Annotation
 */
class ProperMimeType extends Constraint
{
    public $message = 'admin.media.proper_mime_type_invalid {{ valid }}';
}

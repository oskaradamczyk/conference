<?php
/**
 * Created by PhpStorm.
 * User: Oskar Adamczyk
 * Date: 07.09.17
 * Time: 14:10
 */

namespace AppBundle\Validator\Constraints;


use AppBundle\Model\MimeTypeAwareInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

/**
 * Class ProperMimeTypeValidator
 * @package AppBundle\Validator\Constraints
 */
class ProperMimeTypeValidator extends ConstraintValidator
{
    /**
     * @param UploadedFile $file
     * @param Constraint $constraint
     */
    public function validate($file, Constraint $constraint)
    {
        if (($media = $this->context->getObject()) instanceof MimeTypeAwareInterface) {
            $allowedMimeTypes = $media->getAllowedMimeTypes();
            $valid = implode(", ", $allowedMimeTypes);
            if ($file && !in_array($file->getClientMimeType(), $allowedMimeTypes)) {
                $this->context->buildViolation($constraint->message)
                    ->setParameter('{{ valid }}', $valid)
                    ->addViolation();
            }
        }
    }
}

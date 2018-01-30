<?php
/**
 * Created by PhpStorm.
 * User: Oskar Adamczyk
 * Date: 07.09.17
 * Time: 14:10
 */

namespace AppBundle\Validator\Constraints;


use AppBundle\Entity\Lecture;
use AppBundle\Entity\Section;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

/**
 * Class LastIndezactivableValidator
 * @package AppBundle\Validator\Constraints
 */
class LastIndeactivableValidator extends ConstraintValidator
{
    /**
     * @param Lecture $lecture
     * @param Constraint $constraint
     */
    public function validate($lecture, Constraint $constraint)
    {
        /** @var Section $section */
        $section = $lecture->getSection();
        /** @var Lecture $lecture */
        if (!($lecture = $section->getLectures()->get($section->getLectures()->indexOf($lecture) + 1))) {
            $this->context->buildViolation($constraint->message)
                ->addViolation();
        }
    }
}

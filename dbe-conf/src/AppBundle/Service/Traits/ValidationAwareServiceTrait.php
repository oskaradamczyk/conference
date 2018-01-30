<?php
/**
 * Created by PhpStorm.
 * User: Oskar Adamczyk
 * Date: 24.01.18
 * Time: 12:24
 */

namespace AppBundle\Service\Traits;


use AppBundle\Model\AbstractModelInterface;
use Symfony\Component\Validator\ConstraintViolationListInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * Trait ValidationAwareServiceTrait
 * @package AppBundle\Service\Traits
 */
trait ValidationAwareServiceTrait
{
    /** @var ValidatorInterface */
    protected $validator;

    /**
     * @param ValidatorInterface $validator
     */
    public function setValidator(ValidatorInterface $validator): void
    {
        $this->validator = $validator;
    }

    /**
     * @param AbstractModelInterface $lecture
     * @return ConstraintViolationListInterface
     */
    public function validate(AbstractModelInterface $lecture): ConstraintViolationListInterface
    {
        return $this->validator->validate($lecture);
    }
}

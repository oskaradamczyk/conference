<?php
/**
 * Created by PhpStorm.
 * User: Oskar Adamczyk
 * Date: 24.01.18
 * Time: 12:20
 */

namespace AppBundle\Service;


use AppBundle\Model\AbstractModelInterface;
use Symfony\Component\Validator\ConstraintViolationListInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * Interface ValidationAwareInterface
 * @package AppBundle\Service
 */
interface ValidationAwareInterface
{
    /**
     * @param ValidatorInterface $validator
     */
    public function setValidator(ValidatorInterface $validator): void;

    /**
     * @param AbstractModelInterface $model
     * @return ConstraintViolationListInterface
     */
    public function validate(AbstractModelInterface $model): ConstraintViolationListInterface;
}

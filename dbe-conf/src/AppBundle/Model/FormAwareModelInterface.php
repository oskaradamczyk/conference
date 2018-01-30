<?php
/**
 * Created by PhpStorm.
 * User: Oskar Adamczyk
 * Date: 25.01.18
 * Time: 12:07
 */

namespace AppBundle\Model;


/**
 * Interface FormAwareModelInterface
 * @package AppBundle\Model
 */
interface FormAwareModelInterface
{
    /**
     * @return string
     */
    public function getFormClass(): string;
}

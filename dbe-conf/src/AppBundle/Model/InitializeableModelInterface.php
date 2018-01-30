<?php
/**
 * Created by PhpStorm.
 * User: Oskar Adamczyk
 * Date: 24.01.18
 * Time: 12:49
 */

namespace AppBundle\Model;


use Symfony\Component\HttpFoundation\ParameterBag;

/**
 * Interface InitializeableModelInterface
 * @package AppBundle\Model
 */
interface InitializeableModelInterface extends AbstractModelInterface
{
    /**
     * @param ParameterBag $args
     * @return InitializeableModelInterface
     */
    public static function init(ParameterBag $args): InitializeableModelInterface;
}

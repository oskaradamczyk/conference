<?php
/**
 * Created by PhpStorm.
 * User: Oskar Adamczyk
 * Date: 28.01.18
 * Time: 21:40
 */

namespace AppBundle\Admin;


use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Form\FormMapper;

/**
 * Class PossibleAnswerAdmin
 * @package AppBundle\Admin
 */
class PossibleAnswerAdmin extends AbstractAdmin
{
    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('name', null, [
                'label' => 'Nazwa',
                'required' => false
            ])
            ->add('content', null, ['label' => 'Treść']);
    }
}
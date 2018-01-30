<?php
/**
 * Created by PhpStorm.
 * User: Oskar Adamczyk
 * Date: 28.01.18
 * Time: 20:34
 */

namespace AppBundle\Admin;


use AppBundle\Entity\SurveyQuestion;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\ModelType;

/**
 * Class SurveyQuestionAdmin
 * @package AppBundle\Admin
 */
class SurveyQuestionAdmin extends AbstractAdmin
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
            ->add('content', null, ['label' => 'Treść'])
            ->add('type', 'choice', [
                'label' => 'Typ pytania',
                'choices' => SurveyQuestion::getConstants()
            ])
            ->add('possibleAnswers', ModelType::class, [
                'label' => 'Możliwe odpowiedzi',
                'required' => false,
                'multiple' => true
            ]);
    }
}

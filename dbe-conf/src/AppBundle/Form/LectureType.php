<?php
/**
 * Created by PhpStorm.
 * User: Oskar Adamczyk
 * Date: 30.01.18
 * Time: 15:11
 */

namespace AppBundle\Form;


use AppBundle\Entity\Lecture;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class LectureType
 * @package AppBundle\Form\Type
 */
class LectureType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('active', ChoiceType::class, [
                'choices' => [
                    'Yes' => true,
                    'No' => false
                ]
            ]);
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Lecture::class,
            'csrf_protection' => false
        ]);
    }
}

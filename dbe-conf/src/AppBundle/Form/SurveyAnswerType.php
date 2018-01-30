<?php
/**
 * Created by PhpStorm.
 * User: Oskar Adamczyk
 * Date: 29.01.18
 * Time: 15:45
 */

namespace AppBundle\Form;


use AppBundle\Entity\Guest;
use AppBundle\Entity\Slide;
use AppBundle\Entity\SurveyAnswer;
use AppBundle\Form\Type\AnswerType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class SurveyAnswerType
 * @package AppBundle\Form
 */
class SurveyAnswerType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('guest', EntityType::class, [
                'label' => 'Odpowiedź otwarta',
                'class' => Guest::class
            ])
            ->add('slide', EntityType::class, [
                'label' => 'Pytanie',
                'class' => Slide::class
            ])
            ->add('answers', CollectionType::class, [
                'label' => 'Odpowiedzi',
                'entry_type' => AnswerType::class,
                'allow_add' => true
            ]);
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => SurveyAnswer::class,
            'csrf_protection' => false
        ]);
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: Oskar Adamczyk
 * Date: 25.01.18
 * Time: 12:55
 */

namespace AppBundle\Form;


use AppBundle\Entity\Lecture;
use AppBundle\Entity\Question;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class QuestionType
 * @package AppBundle\Form
 */
class QuestionType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('content', TextareaType::class, ['label' => 'Treść'])
            ->add('lecture', EntityType::class, [
                'label' => 'Wykład',
                'class' => Lecture::class
            ])
            ->add('answered', ChoiceType::class, [
                'label' => 'Odpowiedziane',
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
            'data_class' => Question::class,
            'csrf_protection' => false
        ]);
    }
}

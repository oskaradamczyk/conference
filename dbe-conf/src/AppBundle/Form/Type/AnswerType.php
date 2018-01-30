<?php
/**
 * Created by PhpStorm.
 * User: Oskar Adamczyk
 * Date: 29.01.18
 * Time: 11:07
 */

namespace AppBundle\Form\Type;


use AppBundle\Entity\Answer;
use AppBundle\Entity\PossibleAnswer;
use AppBundle\Entity\SurveyQuestion;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class AnswerType
 * @package AppBundle\Form
 */
class AnswerType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('content', TextareaType::class, [
                'label' => 'Odpowiedź otwarta',
                'required' => false
            ])
            ->add('question', EntityType::class, [
                'label' => 'Pytanie',
                'class' => SurveyQuestion::class
            ])
            ->add('possibleAnswer', EntityType::class, [
                'label' => 'Odpowiedź',
                'class' => PossibleAnswer::class,
                'required' => false
            ]);
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Answer::class,
            'csrf_protection' => false
        ]);
    }
}

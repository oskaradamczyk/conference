<?php
/**
 * Created by PhpStorm.
 * User: Oskar Adamczyk
 * Date: 24.01.18
 * Time: 15:17
 */

namespace AppBundle\Form;


use AppBundle\Entity\Guest;
use AppBundle\Entity\Note;
use AppBundle\Entity\Slide;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class NoteType
 * @package AppBundle\Form
 */
class NoteType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('content', EmailType::class, ['label' => 'Email'])
            ->add('slide', EntityType::class, [
                'label' => 'Slajd',
                'class' => Slide::class
            ])
            ->add('guest', EntityType::class, [
                'label' => 'Uczestnik',
                'class' => Guest::class
            ]);
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Note::class,
            'csrf_protection' => false
        ]);
    }
}

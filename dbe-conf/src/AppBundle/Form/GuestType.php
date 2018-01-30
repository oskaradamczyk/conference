<?php
/**
 * Created by PhpStorm.
 * User: Oskar Adamczyk
 * Date: 24.01.18
 * Time: 15:17
 */

namespace AppBundle\Form;


use AppBundle\Entity\Guest;
use AppBundle\Entity\Pdf;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class GuestFormType
 * @package AppBundle\Form
 */
class GuestType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class, [
                'label' => 'Email'
            ])
            ->add('orders', EntityType::class, [
                'label' => 'Zamówione PDF\'y',
                'class' => Pdf::class,
                'multiple' => true
            ]);
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Guest::class,
            'csrf_protection' => false
        ]);
    }
}

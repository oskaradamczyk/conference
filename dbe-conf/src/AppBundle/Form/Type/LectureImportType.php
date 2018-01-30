<?php
/**
 * Created by PhpStorm.
 * User: Oskar Adamczyk
 * Date: 19.01.18
 * Time: 15:41
 */

namespace AppBundle\Form\Type;


use AppBundle\Model\Import;
use AppBundle\Model\LectureImport;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class LectureImportType
 * @package AppBundle\Form\Type
 */
class LectureImportType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('lectureName', TextType::class, ['label' => 'Nazwa wykładu'])
            ->add('file', FileType::class, ['label' => 'Archiwum']);
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => LectureImport::class,
        ]);
    }
}

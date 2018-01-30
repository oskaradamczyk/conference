<?php
/**
 * Created by PhpStorm.
 * User: Oskar Adamczyk
 * Date: 18.01.18
 * Time: 10:10
 */

namespace AppBundle\Admin;

use AppBundle\Entity\Media;
use AppBundle\Model\InteractiveMediaInterface;
use AppBundle\Model\MimeTypeAwareInterface;
use AppBundle\Model\SeoAwareMediaInterface;
use AppBundle\Model\UploadableMediaInterface;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\ModelType;
use Sonata\AdminBundle\Route\RouteCollection;
use Sonata\FormatterBundle\Form\Type\SimpleFormatterType;
use Vich\UploaderBundle\Form\Type\VichFileType;

/**
 * Class SectionAdmin
 * @package AppBundle\Admin
 */
class MediaAdmin extends AbstractAdmin
{
    //TODO surveys / form slides + refactoring with some decorator mby?
    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $object = $this->getSubject();
        $formMapper->add('name', null, [
            'label' => 'Nazwa',
            'required' => false
        ]);
        if ($object instanceof SeoAwareMediaInterface) {
            $formMapper
                ->add('title', null, ['required' => false])
                ->add('alt', null, ['required' => false]);
        }
        if ($object instanceof UploadableMediaInterface) {
            $formMapper->add('file', VichFileType::class, [
                    'required' => false,
                    'allow_delete' => false,
                    'label' => 'Plik'
                ]
            );
            return;
        }
        if ($object instanceof InteractiveMediaInterface) {
            $formMapper->add('questions', ModelType::class, [
                'label' => 'Pytania',
                'required' => false,
                'multiple' => true
            ]);
            return;
        }
        $ckeditorIcons = [
            [
                'Bold', 'Italic', 'Underline',
                '-', 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord',
                '-', 'Undo', 'Redo',
            ], [
                'NumberedList', 'BulletedList',
                '-', 'Outdent', 'Indent',
                '-', 'Blockquote', 'CreateDiv',
            ],
            ['JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock'],
            ['TextColor', 'BGColor'],
            ['Image', 'Link', 'Unlink', 'Table'],
            ['Maximize']
            // TODO CKEditor button 'Source' not working in nested fields
        ];
        $formMapper->add('content', SimpleFormatterType::class, [
            'label' => 'Zawartość',
            'format' => 'richhtml',
            'ckeditor_toolbar_icons' => $ckeditorIcons,
            'attr' => ['class' => 'ckeditor']
        ]);
    }

    /**
     *
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('name', null, ['label' => 'Nazwa pliku'])
            ->add('type', null, ['label' => 'Typ mediów'])
            ->add('createdAt', 'doctrine_orm_date_range', [
                'label' => 'Data dodania',
                'field_type' => 'sonata_type_datetime_range_picker'
            ]);
    }

    /**
     *
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('name', null, ['label' => 'Nazwa pliku'])
            ->add('type', null, ['label' => 'Typ mediów'])
            ->add('getFileUrl', 'url', ['label' => 'Link do pliku'])
            ->add('_action', 'actions', [
                    'label' => 'Akcje',
                    'actions' => [
                        'edit' => [],
                        'delete' => [],
                    ]
                ]
            );
    }

    public function getBatchActions()
    {
        $actions = parent::getBatchActions();
        unset($actions['delete']);

        return $actions;
    }

    /**
     * @param RouteCollection $collection
     */
    protected function configureRoutes(RouteCollection $collection)
    {
        $collection->remove('show');
    }

    /**
     * @param Media $object
     */
    public function prePersist($object)
    {
        if (!$object->getName() && $object instanceof UploadableMediaInterface && ($object instanceof MimeTypeAwareInterface && ($file = $object->getFile()))) {
            $object->setFileName($file->getClientOriginalName());
        }
    }

    /**
     * @param Media $object
     */
    public function preUpdate($object)
    {
        $this->prePersist($object);
    }
}

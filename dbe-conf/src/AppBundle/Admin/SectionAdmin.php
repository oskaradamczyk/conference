<?php
/**
 * Created by PhpStorm.
 * User: Oskar Adamczyk
 * Date: 18.01.18
 * Time: 10:10
 */

namespace AppBundle\Admin;

use AppBundle\Entity\Lecture;
use AppBundle\Entity\Section;
use AppBundle\Entity\Slide;
use Ivory\CKEditorBundle\Form\Type\CKEditorType;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\ModelType;
use Sonata\FormatterBundle\Form\Type\SimpleFormatterType;

/**
 * Class SectionAdmin
 * @package AppBundle\Admin
 */
class SectionAdmin extends AbstractAdmin
{
    /** @var array */
    private $originalLecturesData = [];

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
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
            ['Maximize', 'Source']
        ];
        $this->originalLecturesData = $this->getSubject()->getLectures()->toArray();
        $formMapper
            ->add('name', null, ['label' => 'Nazwa'])
            ->add('active', null, ['label' => 'Aktywna'])
            ->add('agenda', SimpleFormatterType::class, [
                'label' => 'Harmonogram',
                'format' => 'richhtml',
                'ckeditor_toolbar_icons' => $ckeditorIcons,
                'attr' => ['class' => 'ckeditor']
            ])
            ->add('lectures', 'sonata_type_collection', [
                'label' => 'Wykłady',
                'required' => false,
            ], [
                'edit' => 'inline',
                'inline' => 'table'
            ])
            ->add('knowledgeBase', ModelType::class, [
                'label' => 'Baza wiedzy',
                'required' => false
            ]);
    }

    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('name', null, ['label' => 'Nazwa'])
            ->add('active', null, ['label' => 'Aktywna'])
            ->add('createdAt', null, ['label' => 'Data wykładu']);
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('name', null, ['label' => 'Nazwa'])
            ->add('active', null, [
                'label' => 'Aktywna',
                'editable' => true
            ])
            ->add('createdAt', null, ['label' => 'Data wykładu'])
            ->add('_action', 'actions', [
                    'label' => 'Akcje',
                    'actions' => [
                        'edit' => [],
                        'delete' => [],
                    ]
                ]
            );
        //TODO inject into ajax's done for reload page / change other editable fields
    }

    public function configure()
    {
        parent::configure();
        $this->datagridValues['_sort_by'] = 'createdAt';
        $this->datagridValues['_sort_order'] = 'DESC';
    }

    /**
     * @param Section $object
     */
    public function prePersist($object)
    {
        /** @var Lecture $lecture */
        foreach ($object->getLectures() as $lecture) {
            $lecture->setSection($object);
            /** @var Slide $slide */
            foreach ($lecture->getSlides() as $slide) {
                $slide->setLecture($lecture);
            }
        }
        if ($object->getKnowledgeBase()) {
            $object->getKnowledgeBase()->addSection($object);
        }
        foreach ($this->originalLecturesData as $lecture) {
            if (!$object->getLectures()->contains($lecture)) {
                $lecture->setSection(null);
            }
        }
    }

    /**
     * @param Section $object
     */
    public function preUpdate($object)
    {
        $this->prePersist($object);
    }
}

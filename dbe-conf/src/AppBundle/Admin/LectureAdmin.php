<?php
/**
 * Created by PhpStorm.
 * User: Oskar Adamczyk
 * Date: 18.01.18
 * Time: 10:10
 */

namespace AppBundle\Admin;

use AppBundle\Entity\Lecture;
use AppBundle\Entity\Slide;
use AppBundle\Form\Type\LectureImportType;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;

/**
 * Class LectureAdmin
 * @package AppBundle\Admin
 */
class LectureAdmin extends AbstractAdmin
{
    /** @var array */
    private $originalSlidesData = [];

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        if($this->getSubject()) {
            $this->originalSlidesData = $this->getSubject()->getSlides()->toArray();
        }
        $formMapper
            ->add('name', null, ['label' => 'Nazwa'])
            ->add('section', null, ['label' => 'Sekcja'])
            ->add('startAt', 'time', ['label' => 'Czas rozpoczęcia'])
            ->add('active', null, ['label' => 'Aktywna'])
            ->add('slides', 'sonata_type_collection', [
                'label' => 'Slajdy',
                'required' => false,
            ], [
                'edit' => 'inline',
                'inline' => 'table',
                'sortable' => 'position'
            ]);
    }

    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('name', null, ['label' => 'Nazwa'])
            ->add('section', null, ['label' => 'Sekcja'])
            ->add('active', null, ['label' => 'Aktywna'])
            ->add('createdAt', null, ['label' => 'Data dodania']);
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('name', null, ['label' => 'Nazwa'])
            ->add('section', null, ['label' => 'Sekcja'])
            ->add('active', null, [
                'label' => 'Aktywna',
                'editable' => true
            ])
            ->add('createdAt', null, ['label' => 'Data dodania'])
            ->add('_action', 'actions', [
                    'label' => 'Akcje',
                    'actions' => [
                        'edit' => [],
                        'delete' => [],
                    ]
                ]
            );
        $container = $this->configurationPool->getContainer();
        $formFactory = $container->get('form.factory');
        $router = $container->get('router');
        $this->importForm = $formFactory->create(
            LectureImportType::class,
            null,
            ['action' => $router->generate('admin_app_lecture_import')]
        )->createView();
    }

    /**
     * @param Lecture $object
     */
    public function prePersist($object)
    {
        /** @var Slide $slide */
        foreach ($object->getSlides() as $slide) {
            $slide->setLecture($object);
        }
        /** @var Slide $slide */
        foreach ($this->originalSlidesData as $slide) {
            if (!$object->getSlides()->contains($slide)) {
                $slide->setLecture(null);
            }
        }
    }

    /**
     * @param Lecture $object
     */
    public function preUpdate($object)
    {
        $this->prePersist($object);
    }

    public function configure()
    {
        parent::configure();

        $this->datagridValues['_sort_by'] = 'createdAt';
        $this->datagridValues['_sort_order'] = 'DESC';
    }

    /**
     * @param RouteCollection $collection
     */
    public function configureRoutes(RouteCollection $collection)
    {
        $collection->add('import');
    }
}

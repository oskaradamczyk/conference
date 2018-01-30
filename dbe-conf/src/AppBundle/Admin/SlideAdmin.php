<?php
/**
 * Created by PhpStorm.
 * User: Oskar Adamczyk
 * Date: 18.01.18
 * Time: 10:10
 */

namespace AppBundle\Admin;

use AppBundle\Entity\Slide;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\ModelType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

/**
 * Class SlideAdmin
 * @package AppBundle\Admin
 */
class SlideAdmin extends AbstractAdmin
{
    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('name', null, ['label' => 'Nazwa'])
            ->add('position', IntegerType::class, [
                'label' => 'Pozycja',
                'required' => false
            ])
            ->add('active', null, ['label' => 'Aktywny'])
            ->add('lecture', ModelType::class, [
                'label' => 'Wykład',
                'required' => false,
                'btn_add' => false
            ])
            ->add('media', ModelType::class, [
                'label' => 'Plik',
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
            ->add('lecture', null, ['label' => 'Wykład'])
            ->add('active', null, ['label' => 'Aktywny'])
            ->add('createdAt', null, ['label' => 'Data dodania']);
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('name', null, ['label' => 'Nazwa'])
            ->add('lecture', null, ['label' => 'Wykład'])
            ->add('position', null, ['label' => 'Pozycja'])
            ->add('active', null, [
                'label' => 'Aktywny',
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
    }

    /**
     * @param Slide $object
     */
    public function prePersist($object)
    {
        if(!$object->getName()){
            $object->setName($object->getMedia()->getName());
        }
    }

    /**
     * @param Slide $object
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
     * @param array $actions
     * @return array
     */
    public function configureBatchActions($actions)
    {
        $deleteAction = $actions['delete'];
        $actions['activate'] = [
            'ask_confirmation' => true,
            'label' => 'admin.slide.activate_label',
        ];
        $actions['deactivate'] = [
            'ask_confirmation' => true,
            'label' => 'admin.slide.deactivate_label',
        ];
        unset($actions['delete']);
        $actions['delete'] = $deleteAction;

        return $actions;
    }
}

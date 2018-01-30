<?php
/**
 * Created by PhpStorm.
 * User: Oskar Adamczyk
 * Date: 25.01.18
 * Time: 12:56
 */

namespace AppBundle\Admin;


use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Route\RouteCollection;

/**
 * Class QuestionAdmin
 * @package AppBundle\Admin
 */
class QuestionAdmin extends AbstractAdmin
{
    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('content', null, ['label' => 'Treść'])
            ->add('accepted', null, ['label' => 'Zaakceptowane'])
            ->add('answered', null, ['label' => 'Odpowiedziane'])
            ->add('createdAt', null, ['label' => 'Data dodania']);
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('content', null, ['label' => 'Treść'])
            ->add('accepted', null, [
                'label' => 'Zaakceptowane',
                'editable' => true
            ])
            ->add('answered', null, [
                'label' => 'Odpowiedziane'
            ])
            ->add('createdAt', null, ['label' => 'Data dodania']);
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
        $collection->clearExcept('list');
    }
}

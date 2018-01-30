<?php
/**
 * Created by PhpStorm.
 * User: Oskar Adamczyk
 * Date: 23.01.18
 * Time: 11:59
 */

namespace AppBundle\Admin;


use AppBundle\Entity\KnowledgeBase;
use AppBundle\Entity\Section;
use Doctrine\ORM\QueryBuilder;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\ModelType;
use Sonata\DoctrineORMAdminBundle\Model\ModelManager;

/**
 * Class KnowledgeBaseAdmin
 * @package AppBundle\Admin
 */
class KnowledgeBaseAdmin extends AbstractAdmin
{
    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        /** @var ModelManager $mm */
        $mm = $this->modelManager;
        /** @var QueryBuilder $qb */
        $qb = $mm->getEntityManager(Section::class)->createQueryBuilder();
        $qb
            ->select('s')
            ->from('AppBundle:Section', 's')
            ->andWhere('s.knowledgeBase IS null');
        if ($this->getSubject() && $this->getSubject()->getId()) {
            $qb
                ->orWhere('s.knowledgeBase = :base')
                ->setParameter('base', $this->getSubject());
        }
        $formMapper
            ->add('name', null, ['label' => 'Nazwa'])
            ->add('sections', ModelType::class, [
                'label' => 'Sekcje',
                'required' => false,
                'btn_add' => false,
                'multiple' => true,
                'query' => $qb
            ])
            ->add('medias', ModelType::class, [
                'label' => 'PDF',
                'required' => false,
                'multiple' => true
            ]);
    }

    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('name', null, ['label' => 'Nazwa'])
            ->add('createdAt', null, ['label' => 'Data dodania']);
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('name', null, ['label' => 'Nazwa'])
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
     * @param KnowledgeBase $object
     */
    public function prePersist($object)
    {
        /** @var Section $section */
        foreach ($object->getSections() as $section) {
            $section->setKnowledgeBase($object);
        }
    }

    /**
     * @param KnowledgeBase $object
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
}
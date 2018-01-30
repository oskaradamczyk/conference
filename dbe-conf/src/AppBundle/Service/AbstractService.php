<?php
/**
 * Created by PhpStorm.
 * User: Oskar Adamczyk
 * Date: 19.01.18
 * Time: 11:03
 */

namespace AppBundle\Service;


use AppBundle\Model\AbstractModelInterface;
use AppBundle\Model\InitializeableModelInterface;
use AppBundle\Repository\DecoratedRepositoryInterface;
use AppBundle\Repository\QBAwareRepositoryInterface;
use AppBundle\Util\StringHumanizer;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\ParameterBag;

/**
 * Class AbstractService
 * @package AppBundle\Service
 */
abstract class AbstractService implements AbstractServiceInterface
{
    /** @var EntityManagerInterface */
    protected $em;

    /** @var EventDispatcherInterface */
    protected $eventDispatcher;

    /** @var EntityRepository */
    protected $modelRepository;

    /** @var string|InitializeableModelInterface */
    protected $modelClassName;

    /**
     * AbstractService constructor.
     * @param EntityManagerInterface $em
     * @param EventDispatcherInterface $eventDispatcher
     * @param string $modelClassName
     */
    public function __construct(EntityManagerInterface $em, EventDispatcherInterface $eventDispatcher, string $modelClassName)
    {
        $this->em = $em;
        $this->eventDispatcher = $eventDispatcher;
        $this->modelRepository = $em->getRepository($modelClassName);
        $this->modelClassName = $modelClassName;
    }

    /**
     * @return EntityManagerInterface
     */
    public function getManager(): EntityManagerInterface
    {
        return $this->em;
    }

    /**
     * @return EventDispatcherInterface
     */
    public function getEventDispatcher(): EventDispatcherInterface
    {
        return $this->eventDispatcher;
    }

    /**
     * @return DecoratedRepositoryInterface|QBAwareRepositoryInterface|EntityRepository
     */
    public function getRepository(): EntityRepository
    {
        return $this->modelRepository;
    }

    /**
     * @param ParameterBag $filters
     * @return ParameterBag
     */
    public function getFilteredData(ParameterBag $filters): ParameterBag
    {
        return new ParameterBag([
            'data' => $this->getRepository()->getFilteredResult($filters)
        ]);
    }

    /**
     * @param ParameterBag $filters
     * @return ParameterBag
     */
    public function getFilteredDataSet(ParameterBag $filters): ParameterBag
    {
        return new ParameterBag([
            'data' => $this->getRepository()->getFilteredResults($filters)
        ]);
    }

    /**
     * @param ParameterBag $args
     * @return InitializeableModelInterface
     */
    public function create(ParameterBag $args): InitializeableModelInterface
    {
        return $this->modelClassName::init($args);
    }

    /**
     * @param AbstractModelInterface $model
     */
    public function save(AbstractModelInterface $model): void
    {
        $this->em->persist($model);
        $this->em->flush();
    }

    /**
     * @param AbstractModelInterface $model
     * @param ParameterBag $parameters
     */
    public function update(AbstractModelInterface $model, ParameterBag $parameters): void
    {
        foreach ($model->getModelFields() as $fieldName => $field) {
            $setter = 'set' . ucfirst($fieldName);
            if (method_exists($model, $setter) && ($newField = $parameters->get(StringHumanizer::humanize($fieldName)))) {
                $model->$setter($newField);
            }
        }
    }
}

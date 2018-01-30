<?php
/**
 * Created by PhpStorm.
 * User: Oskar Adamczyk
 * Date: 23.01.18
 * Time: 16:14
 */

namespace AppBundle\Entity;


use AppBundle\Entity\Traits\ModelFieldsAccessibleTrait;
use AppBundle\Model\AbstractModelInterface;
use AppBundle\Model\InitializeableModelInterface;
use AppBundle\Model\NameableModelInterface;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMS;
use Symfony\Component\HttpFoundation\ParameterBag;

/**
 * Class AbstractModel
 * @package AppBundle\Entity
 */
abstract class AbstractModel implements InitializeableModelInterface, NameableModelInterface
{
    use ModelFieldsAccessibleTrait;

    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string|null
     *
     * @ORM\Column(type="text", nullable=true)
     * @JMS\Expose()
     */
    protected $name;

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->name ? $this->name : static::class;
    }

    /**
     * @return string
     */
    public static function getFactoryClass(): string
    {
        return (new \ReflectionClass(static::class))->getConstant('FACTORY_CLASS_NAME');
    }

    /**
     * @param ParameterBag $args
     * @return InitializeableModelInterface
     */
    public static function init(ParameterBag $args): InitializeableModelInterface
    {
        $modelClass = static::class;
        return new $modelClass();
    }

    /**
     * @return null|string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param $name
     * @return NameableModelInterface
     */
    public function setName($name): NameableModelInterface
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return AbstractModelInterface
     */
    public function setId(int $id): AbstractModelInterface
    {
        $this->id = $id;
        return $this;
    }
}

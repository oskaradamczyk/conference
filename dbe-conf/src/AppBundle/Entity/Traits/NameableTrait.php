<?php
/**
 * Created by PhpStorm.
 * User: Oskar Adamczyk
 * Date: 17.01.18
 * Time: 15:47
 */

namespace AppBundle\Entity\Traits;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMS;

/**
 * Trait NameableTrait
 * @package AppBundle\Entity\Traits
 */
trait NameableTrait
{
    /**
     * @var string|null
     *
     * @ORM\Column(type="text", nullable=true)
     * @JMS\Expose()
     */
    protected $name;

    /**
     * @return null|string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     * @return NameableTrait
     */
    public function setName($name): self
    {
        $this->name = $name;
        return $this;
    }
}

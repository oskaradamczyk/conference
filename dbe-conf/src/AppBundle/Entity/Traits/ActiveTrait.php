<?php
/**
 * Created by PhpStorm.
 * User: Oskar Adamczyk
 * Date: 18.01.18
 * Time: 10:07
 */

namespace AppBundle\Entity\Traits;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMS;

/**
 * Traits ActiveTrait
 * @package AppBundle\Entity\Traits
 */
trait ActiveTrait
{
    /**
     * @var bool
     *
     * @ORM\Column(type="boolean")
     * @JMS\Expose()
     */
    protected $active = false;

    /**
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->active;
    }

    /**
     * @param bool $active
     * @return ActiveTrait
     */
    public function setActive(bool $active): self
    {
        $this->active = $active;
        return $this;
    }
}

<?php
/**
 * Created by PhpStorm.
 * User: Oskar Adamczyk
 * Date: 17.01.18
 * Time: 15:47
 */

namespace AppBundle\Entity\Traits;

use AppBundle\Model\AbstractModelInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * Trait TimestampableTrait
 * @package AppBundle\Entity\Traits
 */
trait TimestampableTrait
{
    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime")
     */
    protected $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime")
     */
    protected $updatedAt;

    /**
     * @return \DateTime|null
     */
    public function getCreatedAt(): ?\DateTime
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTime $createdAt
     * @return AbstractModelInterface|TimestampableTrait
     */
    public function setCreatedAt(\DateTime $createdAt): AbstractModelInterface
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    /**
     * @return \DateTime|null
     */
    public function getUpdatedAt(): ?\DateTime
    {
        return $this->updatedAt;
    }

    /**
     * @param \DateTime $updatedAt
     * @return AbstractModelInterface|TimestampableTrait
     */
    public function setUpdatedAt(\DateTime $updatedAt): AbstractModelInterface
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }

    /**
     * @ORM\PrePersist
     */
    public function prePersist()
    {
        $this->createdAt = new \DateTime();
        $this->updatedAt = clone $this->createdAt;
    }

    /**
     * @ORM\PreUpdate
     */
    public function preUpdate()
    {
        $this->updatedAt = new \DateTime();
    }
}

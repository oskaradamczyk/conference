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
use JMS\Serializer\Annotation as JMS;

/**
 * Trait IdentityTrait
 * @package AppBundle\Entity\Traits
 */
trait IdentityTrait
{
    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @JMS\Expose()
     */
    protected $id;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return AbstractModelInterface|IdentityTrait
     */
    public function setId(int $id): AbstractModelInterface
    {
        $this->id = $id;
        return $this;
    }
}

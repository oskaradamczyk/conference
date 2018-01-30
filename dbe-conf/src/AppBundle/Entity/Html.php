<?php
/**
 * Created by PhpStorm.
 * User: Oskar Adamczyk
 * Date: 28.08.17
 * Time: 11:26
 */

namespace AppBundle\Entity;


use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMS;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Html
 * @package AppBundle\Entity
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 * @JMS\ExclusionPolicy("all")
 */
class Html extends Media
{
    const MEDIA_TYPE = 'html';

    /**
     * @var string
     *
     * @ORM\Column(type="text")
     * @Assert\NotBlank()
     * @JMS\Expose()
     */
    private $content;

    /**
     * @return null|string
     */
    public function getContent(): ?string
    {
        return $this->content;
    }

    /**
     * @param null|string $content
     * @return Html
     */
    public function setContent(?string $content): Html
    {
        $this->content = $content;
        return $this;
    }
}

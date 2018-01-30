<?php
/**
 * Created by PhpStorm.
 * User: Oskar Adamczyk
 * Date: 25.01.18
 * Time: 09:21
 */

namespace AppBundle\Entity;


use AppBundle\Entity\Traits\FactoryProductTrait;
use AppBundle\Entity\Traits\FormAwareModelTrait;
use AppBundle\Entity\Traits\IdentityTrait;
use AppBundle\Entity\Traits\ModelFieldsAccessibleTrait;
use AppBundle\Entity\Traits\TimestampableTrait;
use AppBundle\Factory\NoteFactory;
use AppBundle\Form\NoteType;
use AppBundle\Model\FormAwareModelInterface;
use AppBundle\Model\InitializeableModelInterface;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\ParameterBag;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Note
 * @package AppBundle\Entity
 * @ORM\Entity()
 * @ORM\HasLifecycleCallbacks()
 */
class Note implements InitializeableModelInterface, FormAwareModelInterface
{
    const FACTORY_CLASS_NAME = NoteFactory::class;
    const FORM_CLASS_NAME = NoteType::class;

    use FactoryProductTrait,
        FormAwareModelTrait,
        IdentityTrait,
        ModelFieldsAccessibleTrait,
        TimestampableTrait;
    /**
     * @var string
     * @ORM\Column(type="text", nullable=true)
     */
    protected $content;

    /**
     * @var Slide
     *
     * @ORM\ManyToOne(targetEntity="Slide", inversedBy="notes")
     * @ORM\JoinColumn(name="slide_id", referencedColumnName="id", onDelete="CASCADE", nullable=false)
     * @Assert\NotBlank()
     */
    protected $slide;

    /**
     * @var Guest
     *
     * @ORM\ManyToOne(targetEntity="Guest", inversedBy="notes")
     * @ORM\JoinColumn(name="guest_id", referencedColumnName="id", onDelete="CASCADE", nullable=false)
     * @Assert\NotBlank()
     */
    protected $guest;

    /**
     * @param ParameterBag $args
     * @return InitializeableModelInterface
     */
    public static function init(ParameterBag $args): InitializeableModelInterface
    {
        $modelClass = static::class;
        /** @var Note $model */
        $model = new $modelClass();
        if ($content = $args->get('content')) {
            $model->setContent($content);
        }
        if (($slide = $args->get('slide')) instanceof Slide){
            $model->setSlide($slide);
        }
        if (($guest = $args->get('guest')) instanceof Guest){
            $model->setGuest($guest);
        }
        return $model;
    }

    /**
     * @return null|string
     */
    public function getContent(): ?string
    {
        return $this->content;
    }

    /**
     * @param string $content
     * @return Note
     */
    public function setContent(string $content): Note
    {
        $this->content = $content;
        return $this;
    }

    /**
     * @return Slide|null
     */
    public function getSlide(): ?Slide
    {
        return $this->slide;
    }

    /**
     * @param Slide $slide
     * @return Note
     */
    public function setSlide(Slide $slide): Note
    {
        $this->slide = $slide;
        return $this;
    }

    /**
     * @return Guest|null
     */
    public function getGuest(): ?Guest
    {
        return $this->guest;
    }

    /**
     * @param Guest $guest
     * @return Note
     */
    public function setGuest(Guest $guest): Note
    {
        $this->guest = $guest;
        return $this;
    }
}

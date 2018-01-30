<?php
/**
 * Created by PhpStorm.
 * User: Oskar Adamczyk
 * Date: 23.01.18
 * Time: 11:19
 */

namespace AppBundle\Entity;


use AppBundle\Entity\Traits\FactoryProductTrait;
use AppBundle\Entity\Traits\FormAwareModelTrait;
use AppBundle\Entity\Traits\IdentityTrait;
use AppBundle\Entity\Traits\ModelFieldsAccessibleTrait;
use AppBundle\Entity\Traits\TimestampableTrait;
use AppBundle\Factory\GuestFactory;
use AppBundle\Form\GuestType;
use AppBundle\Model\FormAwareModelInterface;
use AppBundle\Model\InitializeableModelInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMS;
use Symfony\Component\HttpFoundation\ParameterBag;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Guest
 * @package AppBundle\Entity
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 * @JMS\ExclusionPolicy("all")
 */
class Guest implements InitializeableModelInterface, FormAwareModelInterface
{
    const FACTORY_CLASS_NAME = GuestFactory::class;
    const FORM_CLASS_NAME = GuestType::class;

    use FactoryProductTrait,
        FormAwareModelTrait,
        IdentityTrait,
        ModelFieldsAccessibleTrait,
        TimestampableTrait;

    /**
     * @var string
     *
     * @ORM\Column(type="text")
     * @Assert\Email()
     * @Assert\NotBlank(groups={"registration"})
     * @JMS\Expose()
     */
    protected $email;

    /**
     * @var Collection
     *
     * @ORM\OneToMany(targetEntity="Note", mappedBy="guest")
     */
    protected $notes;

    /**
     * @var Collection
     *
     * @ORM\ManyToMany(targetEntity="Pdf", inversedBy="guests")
     * @ORM\JoinTable(name="guests_pdfs",
     *      joinColumns={@ORM\JoinColumn(name="guest_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="pdf_id", referencedColumnName="id")}
     * )
     */
    protected $orders;

    /**
     * @var Collection
     *
     * @ORM\OneToMany(targetEntity="SurveyAnswer", mappedBy="guest")
     */
    protected $answers;

    /**
     * Slide constructor.
     */
    public function __construct()
    {
        $this->notes = new ArrayCollection();
        $this->orders = new ArrayCollection();
        $this->answers = new ArrayCollection();
    }

    /**
     * @param ParameterBag $args
     * @return InitializeableModelInterface
     */
    public static function init(ParameterBag $args): InitializeableModelInterface
    {
        $modelClass = static::class;
        /** @var Guest $model */
        $model = new $modelClass();
        if ($email = $args->get('email')) {
            $model->setEmail($email);
        }
        return $model;
    }

    /**
     * @return array
     */
    public function getModelFields(): array
    {
        return get_object_vars($this);
    }

    /**
     * @return array
     * @JMS\VirtualProperty(name="orders")
     */
    public function getOrdersIds(): array
    {
        $ordersIds = [];
        /** @var Pdf $order */
        foreach ($this->orders as $order) {
            $ordersIds[] = $order->getId();
        }
        return $ordersIds;
    }

    /**
     * @return array
     * @JMS\VirtualProperty(name="slides")
     */
    public function getAnsweredSlidesIds(): array
    {
        $slidesIds = [];
        /** @var SurveyAnswer $answer */
        foreach ($this->answers as $answer) {
            $slidesIds[] = $answer->getSlide()->getId();
        }
        return $slidesIds;
    }

    /**
     * @return string
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param string|null $email
     * @return Guest
     */
    public function setEmail($email): Guest
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return Collection
     */
    public function getNotes(): Collection
    {
        return $this->notes;
    }

    /**
     * @param Collection|null $notes
     * @return Guest
     */
    public function setNotes($notes): Guest
    {
        if (!$notes) {
            $this->notes = new ArrayCollection();
        }
        $this->notes = $notes;
        return $this;
    }

    /**
     * @param Note $note
     * @return Guest
     */
    public function addNote(Note $note): Guest
    {
        if (!$this->notes->contains($note)) {
            $this->notes->add($note);
        }
        return $this;
    }

    /**
     * @param Note $note
     * @return Guest
     */
    public function removeNote(Note $note): Guest
    {
        if ($this->notes->contains($note)) {
            $this->notes->removeElement($note);
        }
        return $this;
    }

    /**
     * @return Collection
     */
    public function getOrders(): Collection
    {
        return $this->orders;
    }

    /**
     * @param Collection $orders
     * @return Guest
     */
    public function setOrders($orders): Guest
    {
        $this->orders = $orders;
        return $this;
    }

    /**
     * @param Pdf $order
     * @return Guest
     */
    public function addOrder(Pdf $order): Guest
    {
        if (!$this->orders->contains($order)) {
            $this->orders->add($order);
        }
        return $this;
    }

    /**
     * @param Pdf $order
     * @return Guest
     */
    public function removeOrder(Pdf $order): Guest
    {
        if ($this->orders->contains($order)) {
            $this->orders->removeElement($order);
        }
        return $this;
    }

    /**
     * @return Collection
     */
    public function getAnswers(): Collection
    {
        return $this->answers;
    }

    /**
     * @param Collection|null $answers
     * @return Guest
     */
    public function setAnswers($answers): Guest
    {
        if (!$answers) {
            $this->answers = new ArrayCollection();
        }
        $this->answers = $answers;
        return $this;
    }

    /**
     * @param Answer $answer
     * @return Guest
     */
    public function addAnswer(Answer $answer): Guest
    {
        if (!$this->answers->contains($answer)) {
            $this->answers->add($answer);
        }
        return $this;
    }

    /**
     * @param Answer $answer
     * @return Guest
     */
    public function removeAnswer(Answer $answer): Guest
    {
        if ($this->answers->contains($answer)) {
            $this->answers->removeElement($answer);
        }
        return $this;
    }
}

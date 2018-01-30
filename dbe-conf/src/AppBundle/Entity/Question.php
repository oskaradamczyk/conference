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
use AppBundle\Factory\QuestionFactory;
use AppBundle\Form\QuestionType;
use AppBundle\Model\FormAwareModelInterface;
use AppBundle\Model\InitializeableModelInterface;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMS;
use Symfony\Component\HttpFoundation\ParameterBag;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Question
 * @package AppBundle\Entity
 * @ORM\Entity(repositoryClass="AppBundle\Repository\QuestionRepository")
 * @ORM\EntityListeners({"AppBundle\Listener\EntityListener\QuestionListener"})
 * @ORM\HasLifecycleCallbacks
 * @JMS\ExclusionPolicy("all")
 */
class Question implements InitializeableModelInterface, FormAwareModelInterface
{
    const FACTORY_CLASS_NAME = QuestionFactory::class;
    const FORM_CLASS_NAME = QuestionType::class;

    use FactoryProductTrait,
        FormAwareModelTrait,
        IdentityTrait,
        ModelFieldsAccessibleTrait,
        TimestampableTrait;

    /**
     * @var string
     * @ORM\Column(type="text", nullable=true)
     * @JMS\Expose()
     */
    protected $content;

    /**
     * @var Lecture
     *
     * @ORM\ManyToOne(targetEntity="Lecture", inversedBy="questions")
     * @ORM\JoinColumn(name="lecture_id", referencedColumnName="id", onDelete="CASCADE", nullable=false)
     * @Assert\NotBlank()
     */
    protected $lecture;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean")
     * @JMS\Expose()
     */
    protected $answered = false;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean")
     * @JMS\Expose()
     */
    protected $accepted = false;

    /**
     * @param ParameterBag $args
     * @return InitializeableModelInterface
     */
    public static function init(ParameterBag $args): InitializeableModelInterface
    {
        $modelClass = static::class;
        /** @var Question $model */
        $model = new $modelClass();
        if ($content = $args->get('content')) {
            $model->setContent($content);
        }
        return $model;
    }

    /**
     * @return Lecture|null
     */
    public function getLecture(): ?Lecture
    {
        return $this->lecture;
    }

    /**
     * @param Lecture $lecture
     * @return Question
     */
    public function setLecture($lecture): Question
    {
        $this->lecture = $lecture;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getContent(): ?string
    {
        return $this->content;
    }

    /**
     * @param string|null $content
     * @return Question
     */
    public function setContent($content): Question
    {
        $this->content = $content;
        return $this;
    }

    /**
     * @return bool
     */
    public function isAnswered(): bool
    {
        return $this->answered;
    }

    /**
     * @param bool|null $answered
     * @return Question
     */
    public function setAnswered($answered): Question
    {
        $this->answered = boolval($answered);
        return $this;
    }

    /**
     * @return bool
     */
    public function isAccepted(): bool
    {
        return $this->accepted;
    }

    /**
     * @param bool $accepted
     * @return Question
     */
    public function setAccepted(bool $accepted): Question
    {
        $this->accepted = $accepted;
        return $this;
    }
}

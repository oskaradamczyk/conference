<?php
/**
 * Created by PhpStorm.
 * User: Oskar Adamczyk
 * Date: 11.01.18
 * Time: 10:58
 */

namespace AppBundle\Handler\Response;


use JMS\Serializer\Annotation as JMS;
use Symfony\Component\HttpFoundation\ParameterBag;

/**
 * Class HandlerResponse
 * @package AppBundle\Handler\Response
 * @JMS\ExclusionPolicy("all")
 */
class HandlerResponse
{
    const STATUS_SUCCESS = 'success';
    const STATUS_ERROR = 'error';
    const CODE_SUCCESS = 200;
    const CODE_ERROR = 400;
    const STATUS_WARNING = 'warning';
    const SUCCESS_MESSAGE = 'form.success';
    const NOT_SUBMITTED_MESSAGE = 'form.not_submitted';

    public static $defaultAttributes = [
        'message' => null,
        'messageParameters' => []
    ];

    /** @var bool */
    protected $submitted = false;

    /** @var bool */
    protected $valid = false;

    /** @var string */
    protected $status;

    /** @var ParameterBag */
    protected $attributes;

    /**
     * @var int
     * @JMS\Expose()
     */
    protected $code = 200;

    public function __construct()
    {
        $this->attributes = new ParameterBag(self::$defaultAttributes);
    }

    /**
     * @return string|null
     * @JMS\VirtualProperty()
     */
    public function getMessage(): string
    {
        return $this->attributes->get('message');
    }

    /**
     * @return array|null
     * @JMS\VirtualProperty()
     */
    public function getData(): ?array
    {
        foreach (self::$defaultAttributes as $key => $attribute) {
            $this->attributes->remove($key);
        }
        return empty($this->attributes->all()) ? null : $this->attributes->all();
    }

    /**
     * @return int
     */
    public function getCode(): int
    {
        return $this->code;
    }

    /**
     * @param int $code
     * @return HandlerResponse
     */
    public function setCode(int $code): HandlerResponse
    {
        $this->code = $code;
        return $this;
    }

    /**
     * @return bool
     */
    public function isSubmitted()
    {
        return $this->submitted;
    }

    /**
     * @param $submitted
     * @return HandlerResponse
     */
    public function setSubmitted($submitted): HandlerResponse
    {
        $this->submitted = $submitted;
        return $this;
    }

    /**
     * @return bool
     */
    public function isValid()
    {
        return $this->valid;
    }

    /**
     * @param $valid
     * @return HandlerResponse
     */
    public function setValid($valid): HandlerResponse
    {
        $this->valid = $valid;
        return $this;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @param string $status
     * @return HandlerResponse
     */
    public function setStatus(string $status): HandlerResponse
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @return ParameterBag
     */
    public function getAttributes(): ParameterBag
    {
        return $this->attributes;
    }

    /**
     * @param array $attributes
     * @return HandlerResponse
     */
    public function setAttributes(array $attributes): HandlerResponse
    {
        foreach ($attributes as $key => $value) {
            $this->attributes->set($key, $value);
        }
        return $this;
    }

    /**
     * @param string $attribute
     * @return HandlerResponse
     */
    public function addAttribute(string $attribute): HandlerResponse
    {
        $this->attributes->add($attribute);
        return $this;
    }
}

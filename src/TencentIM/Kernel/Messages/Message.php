<?php


namespace EasyIM\TencentIM\Kernel\Messages;


use EasyIM\Kernel\Contracts\MessageInterface;
use EasyIM\Kernel\Traits\HasAttributes;

/**
 * Class Messages.
 */
abstract class Message implements MessageInterface
{
    use HasAttributes;


    /**
     * @var string
     */
    protected $type;


    /**
     * @var array
     */
    protected $properties = [];

    /**
     * Message constructor.
     *
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        $this->setAttributes($attributes);
    }

    /**
     * Return type name message.
     *
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType(string $type)
    {
        $this->type = $type;
    }

    /**
     * Magic getter.
     *
     * @param string $property
     *
     * @return mixed
     */
    public function __get($property)
    {
        if (property_exists($this, $property)) {
            return $this->$property;
        }

        return $this->getAttribute($property);
    }

    /**
     * Magic setter.
     *
     * @param string $property
     * @param mixed  $value
     *
     * @return Message
     */
    public function __set($property, $value)
    {
        if (property_exists($this, $property)) {
            $this->$property = $value;
        } else {
            $this->setAttribute($property, $value);
        }

        return $this;
    }

    /**
     *
     * @param array $appends
     * @param bool  $withType
     *
     * @return array
     */
    public function transformToArray(array $appends = []): array
    {
        $messageType = $this->getType();
        $messageContent = array_merge($this->propertiesToArray([]), $appends);

        return [
            'MsgType' => $messageType,
            'MsgContent' => $messageContent
        ];
    }

    /**
     *
     * @param array $data
     *
     * @return array
     * @throws \EasyIM\Kernel\Exceptions\InvalidArgumentException
     */
    protected function propertiesToArray(array $data): array
    {
        $this->checkRequiredAttributes();

        foreach ($this->attributes as $property => $value) {
            if (is_null($value) && !$this->isRequired($property)) {
                continue;
            }

            $data[$property] = $this->get($property);
        }

        return $data;
    }

    /**
     *
     * @param array $appends
     *
     * @return string
     */
    public function transformToJson(array $appends = []) :string
    {
        return json_encode($this->transformToArray($appends));
    }
}

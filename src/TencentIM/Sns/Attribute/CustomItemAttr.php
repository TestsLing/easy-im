<?php


namespace EasyIM\TencentIM\Sns\Attribute;


use EasyIM\TencentIM\Kernel\Messages\Message;

class CustomItemAttr extends Message
{
    protected $properties = [
        'Tag',
        'Value'
    ];

    /**
     *
     * @param $value
     *
     * @return $this
     */
    public function setTag($value)
    {
        $this->setAttribute('Tag', $value);
        return $this;
    }

    /**
     *
     * @param mixed $value
     *
     * @return $this
     */
    public function setValue($value)
    {
        $this->setAttribute('Value', $value);
        return $this;
    }

    /**
     *
     * @param array $appends
     * @param bool  $isFlat
     *
     * @return array
     * @throws \EasyIM\Kernel\Exceptions\InvalidArgumentException
     */
    public function transformToArray(array $appends = [], bool $isFlat = false): array
    {
        return $this->propertiesToArray($appends);
    }
}

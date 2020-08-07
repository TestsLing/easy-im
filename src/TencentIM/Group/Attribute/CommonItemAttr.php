<?php


namespace EasyIM\TencentIM\Group\Attribute;


use EasyIM\TencentIM\Kernel\Messages\Message;

/**
 * Class CommonItemAttr
 *
 * @package EasyIM\TencentIM\Group\Attribute
 * @author  yingzhan <519203699@qq.com>
 */
class CommonItemAttr extends Message
{
    /**
     * @var array
     */
    protected $properties = [
        'Key',
        'Value'
    ];

    protected $required = [];


    /**
     *
     * @param string $value
     *
     * @return $this
     */
    public function setKey(string $value)
    {
        $this->setAttribute('Key', $value);

        return $this;
    }

    /**
     *
     * @param string $value
     *
     * @return $this
     */
    public function setValue(string $value)
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
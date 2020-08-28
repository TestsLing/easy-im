<?php


namespace EasyIM\TencentIM\Group\Parameter\Base;


use EasyIM\Kernel\Parameter;

/**
 * Class CommonParameter
 *
 * @package EasyIM\TencentIM\Group\Parameter\Base
 * @author  yingzhan <519203699@qq.com>
 *
 */
class CommonParameter extends Parameter
{
    /**
     * @var array
     */
    protected $properties = [
        'Key',
        'Value'
    ];

    protected $required = ['Key', 'Value'];

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
}
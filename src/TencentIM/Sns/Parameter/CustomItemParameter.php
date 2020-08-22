<?php


namespace EasyIM\TencentIM\Sns\Parameter;


use EasyIM\Kernel\Parameter;

class CustomItemParameter extends Parameter
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
}

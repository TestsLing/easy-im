<?php

namespace EasyIM\TencentIM\Kernel\Parameter;

use EasyIM\Kernel\Parameter;

class TagParameter extends Parameter
{
    protected $properties = [
        'Tag',
        'Value'
    ];

    protected $required = ['Tag', 'Value'];

    /**
     *
     * @param string $value
     *
     * @return $this
     */
    public function setTag(string $value)
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

<?php


namespace EasyIM\TencentIM\Group\Parameter\Message;


use EasyIM\Kernel\Parameter;

class MsgSeqListParameter extends Parameter
{
    /**
     * @var array
     */
    protected $properties = [
        'MsgSeq',
    ];

    protected $required = ['MsgSeq'];


    /**
     *
     * @param string $value
     *
     * @return $this
     */
    public function setMsgSeq(int $value)
    {
        $this->setAttribute('MsgSeq', $value);

        return $this;
    }
}
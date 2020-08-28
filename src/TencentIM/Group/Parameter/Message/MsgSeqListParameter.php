<?php


namespace EasyIM\TencentIM\Group\Parameter\Message;


use EasyIM\Kernel\Parameter;

/**
 * Class MsgSeqListParameter
 *
 * @package EasyIM\TencentIM\Group\Parameter\Message
 * @author  yingzhan <519203699@qq.com>
 *
 */
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
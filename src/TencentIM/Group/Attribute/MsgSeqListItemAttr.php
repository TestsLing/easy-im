<?php


namespace EasyIM\TencentIM\Group\Attribute;


use EasyIM\TencentIM\Kernel\Messages\Message;

/**
 * Class MsgSeqListItemAttr
 *
 * @package EasyIM\TencentIM\Group\Attribute
 * @author  yingzhan <519203699@qq.com>
 */
class MsgSeqListItemAttr extends Message
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
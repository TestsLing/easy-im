<?php


namespace EasyIM\TencentIM\Group\Attribute;


use EasyIM\Kernel\Contracts\MessageInterface;
use EasyIM\TencentIM\Kernel\Messages\Message;

/**
 * Class MsgListItemAttr
 *
 * @package EasyIM\TencentIM\Group\Attribute
 * @author  yingzhan <519203699@qq.com>
 */
class MsgListItemAttr extends Message
{
    /**
     * @var array
     */
    protected $properties = [
        'From_Account',
        'SendTime',
        'Random',
        'MsgBody',
    ];

    protected $required = ['From_Account', 'SendTime', 'MsgBody'];


    /**
     *
     * @param string $value
     *
     * @return $this
     */
    public function setFromAccount(string $value)
    {
        $this->setAttribute('From_Account', $value);

        return $this;
    }

    /**
     *
     * @param int $value
     *
     * @return $this
     */
    public function setSendTime(int $value)
    {
        $this->setAttribute('SendTime', $value);

        return $this;
    }


    /**
     *
     * @param string $value
     *
     * @return $this
     */
    public function setRandom(string $value)
    {
        $this->setAttribute('Random', $value);

        return $this;
    }

    /**
     *
     * @param MessageInterface $value
     *
     * @return $this
     */
    public function setMsgBody(MessageInterface $value)
    {
        $this->setAttribute('MsgBody', $value->transformToArray());

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
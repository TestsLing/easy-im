<?php


namespace EasyIM\TencentIM\Group\Attribute;


use EasyIM\TencentIM\Kernel\Messages\Message;

/**
 * Class ImportMemberItemAttr
 *
 * @package EasyIM\TencentIM\Group\Attribute
 * @author  yingzhan <519203699@qq.com>
 */
class ImportMemberItemAttr extends Message
{
    /**
     * @var array
     */
    protected $properties = [
        'Member_Account',
        'Role',
        'JoinTime',
        'UnreadMsgNum',
    ];

    protected $required = ['Member_Account'];


    /**
     *
     * @param string $value
     *
     * @return $this
     */
    public function setMemberAccount(string $value)
    {
        $this->setAttribute('Member_Account', $value);

        return $this;
    }

    /**
     *
     * @param string $value
     *
     * @return $this
     */
    public function setRole(string $value)
    {
        $this->setAttribute('Role', $value);

        return $this;
    }


    /**
     *
     * @param string $value
     *
     * @return $this
     */
    public function setJoinTime(int $value)
    {
        $this->setAttribute('JoinTime', $value);

        return $this;
    }

    /**
     *
     * @param string $value
     *
     * @return $this
     */
    public function setUnreadMsgNum(int $value)
    {
        $this->setAttribute('UnreadMsgNum', $value);

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
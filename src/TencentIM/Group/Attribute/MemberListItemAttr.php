<?php


namespace EasyIM\TencentIM\Group\Attribute;


use EasyIM\Kernel\Contracts\MessageInterface;
use EasyIM\TencentIM\Kernel\Messages\Message;

/**
 * Class MemberListItemAttr
 *
 * @package EasyIM\TencentIM\Group\Attribute
 * @author  yingzhan <519203699@qq.com>
 */
class MemberListItemAttr extends Message
{
    /**
     * @var array
     */
    protected $properties = [
        'Member_Account',
        'Role',
        'AppMemberDefinedData'
    ];

    protected $required = ['Member_Account'];

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
     * @param MessageInterface ...$AppMemberDefineDataItemAttr
     *
     * @return $this
     * @throws \EasyIM\Kernel\Exceptions\InvalidArgumentException
     */
    public function setAppMemberDefinedData(MessageInterface ...$AppMemberDefineDataItemAttr)
    {
        $items = [];

        foreach ($AppMemberDefineDataItemAttr as $item) {
            $items[] = $item->transformToArray();
        }

        $this->setAttribute('AppMemberDefinedData', $items);

        return $this;
    }
}
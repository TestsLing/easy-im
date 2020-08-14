<?php


namespace EasyIM\TencentIM\Group\Attribute;


use EasyIM\TencentIM\Kernel\Messages\Message;

/**
 * Class AddMemberListItemAttr
 *
 * @package EasyIM\TencentIM\Group\Attribute
 * @author  yingzhan <519203699@qq.com>
 */
class AddMemberListItemAttr extends Message
{
    /**
     * @var array
     */
    protected $properties = [
        'Member_Account'
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
     * @param string $value
     *
     * @return $this
     */
    public function setMemberAccount(string $value)
    {
        $this->setAttribute('Member_Account', $value);

        return $this;
    }
}
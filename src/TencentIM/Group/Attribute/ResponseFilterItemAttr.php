<?php


namespace EasyIM\TencentIM\Group\Attribute;


use EasyIM\TencentIM\Kernel\Messages\Message;

/**
 * Class ResponseFilterItemAttr
 *
 * @package EasyIM\TencentIM\Group\Attribute
 * @author  yingzhan <519203699@qq.com>
 */
class ResponseFilterItemAttr extends Message
{
    /**
     * @var array
     */
    protected $properties = [
        'GroupBaseInfoFilter',
        'SelfInfoFilter'
    ];

    protected $required = [];


    /**
     *
     * @param string $value
     *
     * @return $this
     */
    public function setGroupBaseInfoFilter(array $value)
    {
        $this->setAttribute('GroupBaseInfoFilter', $value);

        return $this;
    }

    /**
     *
     * @param string $value
     *
     * @return $this
     */
    public function setSelfInfoFilter(array $value)
    {
        $this->setAttribute('SelfInfoFilter', $value);

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
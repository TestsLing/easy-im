<?php

namespace EasyIM\TencentIM\Group\Parameter\Member;

use EasyIM\Kernel\Parameter;

/**
 * Class ResponseFilterParameter
 *
 * @package EasyIM\TencentIM\Group\Parameter\Member
 * @author  yingzhan <519203699@qq.com>
 *
 */
class ResponseFilterParameter extends Parameter
{
    /**
     * @var array
     */
    protected $properties = [
        'GroupBaseInfoFilter',
        'SelfInfoFilter'
    ];

    /**
     *
     * @param array $value
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
     * @param array $value
     *
     * @return $this
     */
    public function setSelfInfoFilter(array $value)
    {
        $this->setAttribute('SelfInfoFilter', $value);

        return $this;
    }
}

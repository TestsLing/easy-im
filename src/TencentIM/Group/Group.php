<?php

namespace EasyIM\TencentIM\Group;

use EasyIM\Kernel\Exceptions\InvalidArgumentException;

/**
 * Class Group
 *
 * @package EasyIM\TencentIM\Group
 * @author  yingzhan <519203699@qq.com>
 *
 * @property MemberClient  $member
 * @property OperateClient $operate
 * @property MessageClient $message
 * @property ImportClient  $import
 */
class Group extends Client
{
    public function __get($property)
    {
        if (isset($this->app["group.{$property}"])) {
            return $this->app["group.{$property}"];
        }

        throw new InvalidArgumentException(sprintf('No group service named "%s".', $property));
    }
}

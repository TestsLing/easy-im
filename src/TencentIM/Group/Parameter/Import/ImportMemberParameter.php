<?php

namespace EasyIM\TencentIM\Group\Parameter\Import;

use EasyIM\Kernel\Parameter;

/**
 * Class ImportMemberParameter
 *
 * @package EasyIM\TencentIM\Group\Parameter\Import
 * @author  yingzhan <519203699@qq.com>
 *
 */
class ImportMemberParameter extends Parameter
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
     * @param int $value
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
     * @param int $value
     *
     * @return $this
     */
    public function setUnreadMsgNum(int $value)
    {
        $this->setAttribute('UnreadMsgNum', $value);

        return $this;
    }
}

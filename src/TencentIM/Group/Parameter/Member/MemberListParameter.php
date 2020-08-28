<?php


namespace EasyIM\TencentIM\Group\Parameter\Member;


use EasyIM\Kernel\Parameter;
use EasyIM\TencentIM\Group\Parameter\Base\CommonParameter;

/**
 * Class MemberListParameter
 *
 * @package EasyIM\TencentIM\Group\Parameter\Member
 * @author  yingzhan <519203699@qq.com>
 *
 */
class MemberListParameter extends Parameter
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
     * @param CommonParameter ...$AppMemberDefineDataItemAttr
     *
     * @return $this
     * @throws \EasyIM\Kernel\Exceptions\InvalidArgumentException
     */
    public function setAppMemberDefinedData(CommonParameter ...$AppMemberDefineDataItemAttr)
    {
        $parameterList = parameterList(...$AppMemberDefineDataItemAttr);

        $this->setAttribute('AppMemberDefinedData', $parameterList());

        return $this;
    }
}

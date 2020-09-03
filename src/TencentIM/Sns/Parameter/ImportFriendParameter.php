<?php

namespace EasyIM\TencentIM\Sns\Parameter;

use EasyIM\TencentIM\Kernel\Parameter\TagParameter;

/**
 * Class ImportFriendParameter
 *
 * @package EasyIM\TencentIM\Sns\Attribute
 * @author  longing <hacksmile@126.com>
 */
class ImportFriendParameter extends AddFriendParameter
{
    /**
     * @var array
     */
    protected $properties = [
        'To_Account',
        'Remark',
        'GroupName',
        'AddSource',
        'AddWording',
        'RemarkTime',
        'AddTime',
        'CustomItem'
    ];

    /**
     *
     * @param int $value
     *
     * @return $this
     */
    public function setRemarkTime(int $value)
    {
        $this->setAttribute('RemarkTime', $value);

        return $this;
    }

    /**
     *
     * @param int $value
     *
     * @return $this
     */
    public function setAddTime(int $value)
    {
        $this->setAttribute('AddTime', $value);

        return $this;
    }


    /**
     *
     * @param TagParameter ...$tagParameters
     *
     * @return $this
     */
    public function setCustomItem(TagParameter ...$tagParameters)
    {
        $this->setAttribute('CustomItem', parameterList(...$tagParameters)());
        return $this;
    }

    /**
     *
     * @param array $value
     *
     * @return $this
     */
    public function setGroupName($value)
    {
        $this->setAttribute('GroupName', $value);
        return $this;
    }
}

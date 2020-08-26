<?php


namespace EasyIM\TencentIM\Sns\Parameter;


use EasyIM\Kernel\ParameterList;

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
     * @param CustomItemParameter ...$customItemParameters
     *
     * @return $this
     * @throws \EasyIM\Kernel\Exceptions\InvalidArgumentException
     */
    public function setCustomItem(CustomItemParameter ...$customItemParameters)
    {
        $parameterList = new ParameterList(...$customItemParameters);
        
        $this->setAttribute('CustomItem', $parameterList->transformParameterToArray());

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

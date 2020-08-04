<?php


namespace EasyIM\TencentIM\Sns\Attribute;


use EasyIM\TencentIM\Kernel\Messages\Message;

/**
 * Class ImportFriendItemAttr
 *
 * @package EasyIM\TencentIM\Sns\Attribute
 * @author  longing <hacksmile@126.com>
 */
class ImportFriendItemAttr extends AddFriendItemAttr
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
        'CustomItemAttr'
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
     * @param CustomItemAttr ...$customItemAttr
     *
     * @return $this
     * @throws \EasyIM\Kernel\Exceptions\InvalidArgumentException
     */
    public function setCustomItem(CustomItemAttr ...$customItemAttr)
    {
        $customItems = [];

        foreach ($customItemAttr as $item) {
            $customItems[] = $item->transformToArray();
        }

        $this->setAttribute('CustomItemAttr', $customItems);
        return $this;
    }
}

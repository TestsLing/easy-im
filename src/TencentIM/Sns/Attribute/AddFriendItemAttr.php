<?php


namespace EasyIM\TencentIM\Sns\Attribute;


use EasyIM\TencentIM\Kernel\Messages\Message;

class AddFriendItemAttr extends Message
{

    /**
     * @var array
     */
    protected $properties = [
        'To_Account',
        'Remark',
        'GroupName',
        'AddSource',
        'AddWording'
    ];

    protected $required = ['AddSource', 'To_Account'];

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
    public function setToAccount(string $value)
    {
        $this->setAttribute('To_Account', $value);
        return $this;
    }

    /**
     *
     * @param string $value
     *
     * @return $this
     */
    public function setRemark(string $value)
    {
        $this->setAttribute('Remark', $value);
        return $this;
    }

    /**
     *
     * @param string $value
     *
     * @return $this
     */
    public function setGroupName(string $value)
    {
        $this->setAttribute('GroupName', $value);
        return $this;
    }

    /**
     *
     * @param string $value
     *
     * @return $this
     */
    public function setAddSource(string $value)
    {
        $this->setAttribute('AddSource', $value);
        return $this;
    }

    /**
     *
     * @param string $value
     *
     * @return $this
     */
    public function setAddWording(string $value)
    {
        $this->setAttribute('AddWording', $value);
        return $this;
    }

}

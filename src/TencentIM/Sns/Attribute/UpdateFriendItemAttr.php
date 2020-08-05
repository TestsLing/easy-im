<?php


namespace EasyIM\TencentIM\Sns\Attribute;


use EasyIM\TencentIM\Kernel\Messages\Message;

class UpdateFriendItemAttr extends Message
{
    protected $properties = [
        'To_Account',
        'SnsItem'
    ];

    protected $required = ['To_Account', 'SnsItem'];

    /**
     *
     * @param SnsItemAttr ...$snsItemAttr
     *
     * @return $this
     */
    public function setSnsItem(SnsItemAttr ...$snsItemAttr)
    {
        $snsItems = [];

        foreach ($snsItemAttr as $snsItem) {
            $snsItems[] = $snsItem->transformToArray();
        }

        $this->setAttribute('SnsItem', $snsItems);

        return $this;
    }

    public function setToAccount(string $account)
    {
        $this->setAttribute('To_Account', $account);

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

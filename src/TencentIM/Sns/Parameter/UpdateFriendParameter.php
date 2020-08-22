<?php


namespace EasyIM\TencentIM\Sns\Parameter;


use EasyIM\Kernel\Parameter;

class UpdateFriendParameter extends Parameter
{
    protected $properties = [
        'To_Account',
        'SnsItem'
    ];

    protected $required = ['To_Account', 'SnsItem'];

    /**
     *
     * @param SnsItemParameter ...$snsItemAttr
     *
     * @return $this
     */
    public function setSnsItem(SnsItemParameter ...$snsItemAttr)
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

}

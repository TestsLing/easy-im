<?php

namespace EasyIM\TencentIM\Sns\Parameter;

use EasyIM\Kernel\Parameter;
use EasyIM\TencentIM\Kernel\Parameter\TagParameter;

/**
 * Class UpdateFriendParameter
 *
 * @package EasyIM\TencentIM\Sns\Parameter
 * @author  longing <hacksmile@126.com>
 */
class UpdateFriendParameter extends Parameter
{
    protected $properties = [
        'To_Account',
        'SnsItem'
    ];

    protected $required = ['To_Account', 'SnsItem'];

    /**
     *
     * @param TagParameter ...$tagParameters
     *
     * @return $this
     */
    public function setSnsItem(TagParameter ...$tagParameters)
    {
        $this->setAttribute('SnsItem', parameterList(...$tagParameters)());
        return $this;
    }

    public function setToAccount(string $account)
    {
        $this->setAttribute('To_Account', $account);

        return $this;
    }
}

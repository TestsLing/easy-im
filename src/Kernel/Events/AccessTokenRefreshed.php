<?php

/*
 * This file is part of the overtrue/wechat.
 *
 * (c) overtrue <i@overtrue.me>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace EasyIM\Kernel\Events;

use EasyIM\Kernel\AccessToken;

/**
 * Class AccessTokenRefreshed.
 *
 * @author mingyoung <mingyoungcheung@gmail.com>
 */
class AccessTokenRefreshed
{
    /**
     * @var \EasyIM\Kernel\AccessToken
     */
    public $accessToken;

    /**
     * @param \EasyIM\Kernel\AccessToken $accessToken
     */
    public function __construct(AccessToken $accessToken)
    {
        $this->accessToken = $accessToken;
    }
}

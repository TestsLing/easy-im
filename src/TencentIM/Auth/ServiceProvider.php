<?php

/*
 * This file is part of the overtrue/wechat.
 *
 * (c) overtrue <i@overtrue.me>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace EasyIM\TencentIM\Auth;

use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Tencent\TLSSigAPIv2;

/**
 * Class ServiceProvider
 *
 * @package EasyIM\TencentIM\Auth
 * @author  longing <hacksmile@126.com>
 */
class ServiceProvider implements ServiceProviderInterface
{
    /**
     * {@inheritdoc}.
     */
    public function register(Container $app)
    {
        !isset($app['access_token']) && $app['access_token'] = function ($app) {
            return new AccessToken($app);
        };

        $app['sign'] = function ($app) {
            return new TLSSigAPIv2(
                $app['config']['sdk_app_id'],
                $app['config']['secret']
            );
        };
    }
}

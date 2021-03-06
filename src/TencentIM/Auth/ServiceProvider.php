<?php

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

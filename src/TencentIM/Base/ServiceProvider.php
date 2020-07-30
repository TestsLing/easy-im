<?php

namespace EasyIM\TencentIM\Base;

use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Tencent\TLSSigAPIv2;

/**
 * Class ServiceProvider.
 */
class ServiceProvider implements ServiceProviderInterface
{
    /**
     * {@inheritdoc}.
     */
    public function register(Container $app)
    {

        $app['base'] = function ($app) {
            return new Client($app);
        };

        $app['sign'] = function ($app) {
            return new TLSSigAPIv2(
                $app['config']['sdk_app_id'],
                $app['config']['secret']
            );
        };

    }
}

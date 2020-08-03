<?php

namespace EasyIM\TencentIM\Kernel\Providers;

use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Tencent\TLSSigAPIv2;

/**
 * Class SignatureProvider.
 */
class SignatureProvider implements ServiceProviderInterface
{
    /**
     * {@inheritdoc}.
     */
    public function register(Container $app)
    {

        $app['sign'] = function ($app) {
            return new TLSSigAPIv2(
                $app['config']['sdk_app_id'],
                $app['config']['secret']
            );
        };

    }
}

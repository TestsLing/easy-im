<?php

namespace EasyIM\TencentIM\Sns;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

/**
 * Class SignatureProvider.
 */
class ServiceProvider implements ServiceProviderInterface
{
    /**
     * {@inheritdoc}.
     */
    public function register(Container $app)
    {
        $app['sns'] = function ($app) {
            return new Client($app);
        };
    }
}

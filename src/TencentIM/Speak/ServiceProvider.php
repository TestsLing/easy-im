<?php

namespace EasyIM\TencentIM\Speak;

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
        $app['speak'] = function ($app) {
            return new Client($app);
        };
    }
}

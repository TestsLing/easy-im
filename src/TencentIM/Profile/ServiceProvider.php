<?php

namespace EasyIM\TencentIM\Profile;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

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
        $app['profile'] = function ($app) {
            return new Client($app);
        };
    }
}

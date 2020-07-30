<?php

namespace EasyIM\TencentIM\Group;

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
        $app['group'] = function ($app) {
            return new Client($app);
        };
    }
}
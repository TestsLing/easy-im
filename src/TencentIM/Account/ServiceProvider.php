<?php

namespace EasyIM\TencentIM\Account;

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
        $app['account'] = function ($app) {
            return new Client($app);
        };
    }
}

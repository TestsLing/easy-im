<?php

namespace EasyIM\TencentIM\SingleChat;

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
        $app['single_chat'] = function ($app) {
            return new Client($app);
        };
    }
}

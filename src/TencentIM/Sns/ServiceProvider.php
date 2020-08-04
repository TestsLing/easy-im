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
            return new Sns($app);
        };

        $app['sns.client'] = function ($app) {
            return new Client($app);
        };

        $app['sns.group'] = function ($app) {
            return new GroupClient($app);
        };

        $app['sns.black_list'] = function ($app) {
            return new BlackListClient($app);
        };
    }
}

<?php

namespace EasyIM\TencentIM\Speak;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

/**
 * Class ServiceProvider
 *
 * @package EasyIM\TencentIM\Speak
 * @author  longing <hacksmile@126.com>
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

<?php

namespace EasyIM\TencentIM\Group;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

/**
 * Class ServiceProvider
 *
 * @package EasyIM\TencentIM\Group
 * @author  yingzhan <519203699@qq.com>
 */
class ServiceProvider implements ServiceProviderInterface
{
    /**
     * {@inheritdoc}.
     */
    public function register(Container $app)
    {
        $app['group'] = function ($app) {
            return new Group($app);
        };
        $app['group.client'] = function ($app) {
            return new Client($app);
        };
        $app['group.member'] = function ($app) {
            return new MemberClient($app);
        };
        $app['group.operate'] = function ($app) {
            return new OperateClient($app);
        };
        $app['group.message'] = function ($app) {
            return new MessageClient($app);
        };
        $app['group.import'] = function ($app) {
            return new ImportClient($app);
        };
    }
}

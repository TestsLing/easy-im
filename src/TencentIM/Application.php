<?php

namespace EasyIM\TencentIM;

use EasyIM\Kernel\ServiceContainer;

/**
 * Class Application.
 *
 * @author  yingzhan <519203699@qq.com>
 *
 * @property \EasyIM\TencentIM\Group\Client                       $group
 * @property \EasyIM\TencentIM\Operate\Client                     $operate
 * @property \EasyIM\TencentIM\Speak\Client                       $speak
 * @property \EasyIM\TencentIM\Profile\Client                     $profile
 * @property \EasyIM\TencentIM\Account\Client                     $account
 * @property \EasyIM\TencentIM\SingleChat\Client                  $single_chat
 * @property \EasyIM\TencentIM\Sns\Client                         $sns
 */
class Application extends ServiceContainer
{
    /**
     * @var array
     */
    protected $providers = [
        Auth\ServiceProvider::class,
        Operate\ServiceProvider::class,
        Speak\ServiceProvider::class,
        Profile\ServiceProvider::class,
        Account\ServiceProvider::class,
        SingleChat\ServiceProvider::class,
        Sns\ServiceProvider::class,
        Group\ServiceProvider::class,
    ];
}

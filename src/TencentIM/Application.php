<?php

namespace EasyIM\TencentIM;

use EasyIM\Kernel\ServiceContainer;
use EasyIM\TencentIM\Kernel\Providers\SignatureProvider;

class Application extends ServiceContainer
{
    /**
     * @var array
     */
    protected $providers = [
        SignatureProvider::class,
        Operate\ServiceProvider::class,
        Speak\ServiceProvider::class,
        Profile\ServiceProvider::class,
        Account\ServiceProvider::class,
        SingleChat\ServiceProvider::class,
        Sns\ServiceProvider::class,

    ];
}

<?php

namespace EasyIM\TencentIM;

use EasyIM\Kernel\ServiceContainer;

class Application extends ServiceContainer
{
    /**
     * @var array
     */
    protected $providers = [
        Base\ServiceProvider::class,
    ];
}

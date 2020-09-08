<?php

namespace EasyTM\Tests\TencentIM;

use EasyIM\TencentIM\Application;
use PHPUnit\Framework\TestCase;

class ApplicationTest extends TestCase
{
    public function testProperties()
    {
        $app = new Application();
        $this->assertInstanceOf(\EasyIM\TencentIM\Account\Client::class, $app->account);
        $this->assertInstanceOf(\EasyIM\TencentIM\Sns\Client::class, $app->sns);
        $this->assertInstanceOf(\EasyIM\TencentIM\Speak\Client::class, $app->speak);
        $this->assertInstanceOf(\EasyIM\TencentIM\SingleChat\Client::class, $app->single_chat);
        $this->assertInstanceOf(\EasyIM\TencentIM\Operate\Client::class, $app->operate);
        $this->assertInstanceOf(\EasyIM\TencentIM\Profile\Client::class, $app->profile);
        $this->assertInstanceOf(\EasyIM\TencentIM\Group\Client::class, $app->group);
    }
}

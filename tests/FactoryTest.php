<?php

namespace EasyTM\Tests;

use EasyIM\Factory;
use EasyIM\TencentIM\Application;
use PHPUnit\Framework\TestCase;

class FactoryTest extends TestCase
{
    public function testNewFactory()
    {
        $tencentIM = Factory::TencentIM([]);
        $tencentIMFromMake = Factory::make('TencentIM', []);

        self::assertInstanceOf(Application::class, $tencentIM);
        self::assertInstanceOf(Application::class, $tencentIMFromMake);

        $expected = [];
        self::assertArraySubset($expected, $tencentIM['config']->all());
        self::assertArraySubset($expected, $tencentIMFromMake['config']->all());

        $tencentIMAccount = $tencentIM->account;
        $tencentIMGroup = $tencentIM->group;
        $tencentIMOperate = $tencentIM->operate;
        $tencentIMProfile = $tencentIM->profile;
        $tencentIMSingleChat = $tencentIM->single_chat;
        $tencentIMSns = $tencentIM->sns;
        $tencentIMSpeak = $tencentIM->speak;

        self::assertInstanceOf(\EasyIM\TencentIM\Account\Client::class, $tencentIMAccount);
        self::assertInstanceOf(\EasyIM\TencentIM\Group\Client::class, $tencentIMGroup);
        self::assertInstanceOf(\EasyIM\TencentIM\Operate\Client::class, $tencentIMOperate);
        self::assertInstanceOf(\EasyIM\TencentIM\Profile\Client::class, $tencentIMProfile);
        self::assertInstanceOf(\EasyIM\TencentIM\SingleChat\Client::class, $tencentIMSingleChat);
        self::assertInstanceOf(\EasyIM\TencentIM\Sns\Client::class, $tencentIMSns);
        self::assertInstanceOf(\EasyIM\TencentIM\Speak\Client::class, $tencentIMSpeak);
    }
}

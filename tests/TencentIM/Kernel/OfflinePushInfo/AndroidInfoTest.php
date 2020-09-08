<?php

namespace EasyTM\Tests\TencentIM\Kernel\OfflinePushInfo;

use EasyIM\TencentIM\Kernel\OfflinePushInfo\AndroidInfo;
use PHPUnit\Framework\TestCase;

class AndroidInfoTest extends TestCase
{
    public function testBasicFeatures()
    {
        $androidInfo = new AndroidInfo();
        $androidInfo->setSound('sound');
        $androidInfo->setOPPOChannelID('com.easy.im');

        $this->assertSame(['Sound' => 'sound', 'OPPOChannelID' => 'com.easy.im'], $androidInfo->transformToArray());
    }
}

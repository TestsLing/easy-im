<?php

namespace EasyTM\Tests\TencentIM\Kernel\OfflinePushInfo;

use EasyIM\TencentIM\Kernel\OfflinePushInfo\ApnsInfo;
use PHPUnit\Framework\TestCase;

class ApnsInfoTest extends TestCase
{
    public function testBasicFeatures()
    {
        $apnsInfo = new ApnsInfo();
        $apnsInfo->setSubTitle('sub_title');
        $apnsInfo->setTitle('title');
        $apnsInfo->setImage('https://easyim.cn/easy.png');
        $apnsInfo->setBadgeMode(1);
        $apnsInfo->setSound('sound');

        $data = [
            'SubTitle' => 'sub_title',
            'Title' => 'title',
            'Image' => 'https://easyim.cn/easy.png',
            'BadgeMode' => 1,
            'Sound' => 'sound',
        ];

        $this->assertSame($data, $apnsInfo->transformToArray());
    }
}

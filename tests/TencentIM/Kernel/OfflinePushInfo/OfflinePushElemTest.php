<?php

namespace EasyTM\Tests\TencentIM\Kernel\OfflinePushInfo;

use EasyIM\TencentIM\Kernel\OfflinePushInfo\AndroidInfo;
use EasyIM\TencentIM\Kernel\OfflinePushInfo\ApnsInfo;
use EasyIM\TencentIM\Kernel\OfflinePushInfo\OfflinePushElem;
use PHPUnit\Framework\TestCase;

class OfflinePushElemTest extends TestCase
{
    public function testBasicFeatures()
    {
        $offlinePushElem = new OfflinePushElem();

        // android
        $androidInfo = new AndroidInfo();
        $androidInfo->setSound('sound');
        $androidInfo->setOPPOChannelID('com.easy.im');

        // apns
        $apnsInfo = new ApnsInfo();
        $apnsInfo->setSubTitle('sub_title');
        $apnsInfo->setTitle('title');
        $apnsInfo->setImage('https://easyim.cn/easy.png');
        $apnsInfo->setBadgeMode(1);
        $apnsInfo->setSound('sound');

        $offlinePushElem->setApnsInfo($apnsInfo);
        $offlinePushElem->setAndroidInfo($androidInfo);

        // attrs
        $offlinePushElem->setTitle('title');
        $offlinePushElem->setPushFlag(1);
        $offlinePushElem->setDesc('desc');
        $offlinePushElem->setExt(json_encode(['ext' => 'extData']));

        // mock
        $data = [
            'ApnsInfo' => [
                'SubTitle' => 'sub_title',
                'Title' => 'title',
                'Image' => 'https://easyim.cn/easy.png',
                'BadgeMode' => 1,
                'Sound' => 'sound',
            ],
            'AndroidInfo' => [
                'Sound' => 'sound',
                'OPPOChannelID' => 'com.easy.im'
            ],
            'Title' => 'title',
            'PushFlag' => 1,
            'Desc' => 'desc',
            'Ext' => json_encode(['ext' => 'extData']),
        ];

        $this->assertSame($data, $offlinePushElem->transformToArray());
    }
}

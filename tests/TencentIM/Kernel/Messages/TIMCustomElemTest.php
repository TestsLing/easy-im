<?php

namespace EasyTM\Tests\TencentIM\Kernel\Messages;

use EasyIM\TencentIM\Kernel\Messages\TIMCustomElem;
use PHPUnit\Framework\TestCase;

class TIMCustomElemTest extends TestCase
{
    public function testBasicFeatures()
    {
        $tIMTextElem = new TIMCustomElem(json_encode(['key' => 'data']));
        $this->assertSame(['key' => 'data'], json_decode($tIMTextElem->Data, true));
    }
}

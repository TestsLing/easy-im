<?php

namespace EasyTM\Tests\TencentIM\Kernel\Messages;

use EasyIM\TencentIM\Kernel\Messages\TIMLocationElem;
use PHPUnit\Framework\TestCase;

class TIMLocationElemTest extends TestCase
{
    public function testBasicFeatures()
    {
        $tIMTextElem = new TIMLocationElem('test', 111.01, 12.02);
        $this->assertSame('test', $tIMTextElem->Desc);
        $this->assertSame(111.01, $tIMTextElem->Latitude);
        $this->assertSame(12.02, $tIMTextElem->Longitude);
    }
}

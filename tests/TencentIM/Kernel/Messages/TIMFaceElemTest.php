<?php

namespace EasyTM\Tests\TencentIM\Kernel\Messages;

use EasyIM\TencentIM\Kernel\Messages\TIMFaceElem;
use PHPUnit\Framework\TestCase;

class TIMFaceElemTest extends TestCase
{
    public function testBasicFeatures()
    {
        $tIMTextElem = new TIMFaceElem('key', 'data');
        $this->assertSame('key', $tIMTextElem->Index);
        $this->assertSame('data', $tIMTextElem->Data);
    }
}

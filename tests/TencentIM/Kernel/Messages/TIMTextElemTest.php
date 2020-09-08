<?php

namespace EasyTM\Tests\TencentIM\Kernel\Messages;

use EasyIM\TencentIM\Kernel\Messages\TIMTextElem;
use PHPUnit\Framework\TestCase;

class TIMTextElemTest extends TestCase
{
    public function testBasicFeatures()
    {
        $tIMTextElem = new TIMTextElem('hello easyIM!');
        $this->assertSame('hello easyIM!', $tIMTextElem->Text);
    }
}

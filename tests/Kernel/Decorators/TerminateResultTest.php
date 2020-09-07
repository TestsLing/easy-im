<?php

namespace EasyTM\Tests\Kernel\Decorators;

use EasyIM\Kernel\Decorators\TerminateResult;
use PHPUnit\Framework\TestCase;

class TerminateResultTest extends TestCase
{
    public function testGetContent()
    {
        $result = new TerminateResult('foo');

        self::assertSame('foo', $result->content);
    }
}

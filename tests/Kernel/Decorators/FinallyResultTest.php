<?php

namespace EasyTM\Tests\Kernel\Decorators;

use EasyIM\Kernel\Decorators\FinallyResult;
use PHPUnit\Framework\TestCase;

class FinallyResultTest extends TestCase
{
    public function testGetContent()
    {
        $result = new FinallyResult('foo');

        self::assertSame('foo', $result->content);
    }
}

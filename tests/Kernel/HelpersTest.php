<?php

namespace EasyTM\Tests\Kernel;

use EasyIM\Kernel\ParameterList;
use PHPUnit\Framework\TestCase;

class HelpersTest extends TestCase
{
    public function testMsgRandom()
    {
        $str = (string) msgRandom();
        $this->assertEquals(5, strlen($str));

        $str10 = (string) msgRandom(10);
        $this->assertEquals(10, strlen($str10));

    }

    public function testParameterList()
    {
        $parameterList = parameterList();
        $this->assertInstanceOf(ParameterList::class, $parameterList);
    }

    public function testFree()
    {
        $this->assertTrue(free(null));
        $this->assertTrue(free(''));
        $this->assertTrue(free(false));
        $this->assertTrue(free([]));
    }

}

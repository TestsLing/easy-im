<?php

namespace EasyTM\Tests\Kernel;

use EasyIM\Kernel\Parameter;
use PHPUnit\Framework\TestCase;

class ParameterTest extends TestCase
{
    public function testParameter()
    {
        $parameterOther = new ParameterOtherTest([]);
        self::assertSame([], $parameterOther->all());

        $parameterOtherToArray = new ParameterOtherTest(['url' => 'http://easyim.cn']);
        self::assertSame(['url' => 'http://easyim.cn'], $parameterOtherToArray->transformToArray());
    }
}

class ParameterOtherTest extends Parameter
{
    protected $properties;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }
}

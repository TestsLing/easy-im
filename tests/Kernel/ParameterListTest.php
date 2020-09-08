<?php

namespace EasyTM\Tests\Kernel;

use EasyIM\Kernel\Parameter;
use EasyIM\Kernel\ParameterList;
use EasyIM\TencentIM\Kernel\Parameter\TagParameter;
use PHPUnit\Framework\TestCase;

class ParameterListTest extends TestCase
{
    public function testParameterList()
    {
        $tagParameter = new TagParameter();
        $tagParameter->setTag('tag');
        $tagParameter->setValue('easy_im');
        $parameterList = new ParameterList($tagParameter);
        self::assertInstanceOf(ParameterList::class, $parameterList);
        self::assertInstanceOf(Parameter::class, $parameterList);
        self::assertSame([['Tag' => 'tag', 'Value' => 'easy_im']], $parameterList());
    }
}

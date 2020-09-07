<?php

namespace EasyTM\Tests\TencentIM\Kernel\Parameter;

use EasyIM\TencentIM\Kernel\Parameter\TagParameter;
use PHPUnit\Framework\TestCase;

class TagParameterTest extends TestCase
{
    public function testBasicFeatures()
    {
        $tag = ['Tag' => 'tag', 'Value' => 'value'];

        $tagParameter = new TagParameter($tag);

        $this->assertSame($tag, $tagParameter->transformToArray());
    }
}

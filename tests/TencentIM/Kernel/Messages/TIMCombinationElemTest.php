<?php

namespace EasyTM\Tests\TencentIM\Kernel\Messages;

use EasyIM\TencentIM\Kernel\Messages\TIMCombinationElem;
use EasyIM\TencentIM\Kernel\Messages\TIMCustomElem;
use EasyIM\TencentIM\Kernel\Messages\TIMTextElem;
use PHPUnit\Framework\TestCase;

class TIMCombinationElemTest extends TestCase
{

    public function testTransformToArray()
    {
        $timTextElem = new TIMTextElem('TimText');
        $tiMCustomElem = new TIMCustomElem(json_encode(['key' => 'data']));

        $timCombinationElem = new TIMCombinationElem($timTextElem, $tiMCustomElem);
        $combinationElemMsgBody = $timCombinationElem->transformToArray([], true);

        $messages = [$timTextElem->transformToArray([], true), $tiMCustomElem->transformToArray([], true)];

        $this->assertSame($messages, $combinationElemMsgBody);
    }

    public function testTransformToJson()
    {
        $timTextElem = new TIMTextElem('TimText');
        $tiMCustomElem = new TIMCustomElem(json_encode(['key' => 'data']));

        $timCombinationElem = new TIMCombinationElem($timTextElem, $tiMCustomElem);
        $combinationElemMsgBody = $timCombinationElem->transformToArray([], true);

        $messages = [$timTextElem->transformToArray([], true), $tiMCustomElem->transformToArray([], true)];

        $this->assertSame(json_encode($messages), json_encode($combinationElemMsgBody));
    }
}

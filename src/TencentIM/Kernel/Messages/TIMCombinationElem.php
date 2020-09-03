<?php

namespace EasyIM\TencentIM\Kernel\Messages;

use EasyIM\Kernel\Contracts\MessageInterface;

/**
 * Class TIMCombinationElem
 *
 * @package EasyIM\TencentIM\Kernel\Messages
 * @author  longing <hacksmile@126.com>
 */
class TIMCombinationElem implements MessageInterface
{
    public $type = 'TIMCombinationElem';

    protected $messages = [];

    public function __construct(Message ...$messages)
    {
        $this->messages = $messages;
    }

    public function transformToArray(array $appends = [], bool $isFlat = true): array
    {
        $msgBody = [];

        foreach ($this->messages as $message) {
            $msgBody[] = $message->transformToArray($appends, $isFlat);
        }

        return $msgBody;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function transformToJson(): string
    {
        return json_encode($this->transformToArray());
    }
}

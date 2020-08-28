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

    public function transformToArray(): array
    {
        $msgBody = [];

        foreach ($this->messages as $message) {
            $msgBody[] = $message->transformToArray([], true);
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

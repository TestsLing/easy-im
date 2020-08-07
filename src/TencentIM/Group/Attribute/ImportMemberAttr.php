<?php


namespace EasyIM\TencentIM\Group\Attribute;


use EasyIM\Kernel\Contracts\MessageInterface;

class ImportMemberAttr implements MessageInterface
{
    protected $items;

    public function __construct(MessageInterface ...$items)
    {
        $this->items = $items;
    }

    public function getType(): string
    {
        return 'MemberList';
    }

    public function transformToArray(): array
    {
        $attrs = [];

        foreach ($this->items as $item) {
            $attrs[] = $item->transformToArray();
        }

        return $attrs;
    }

    public function transformToJson(): string
    {
        return json_encode($this->transformToArray());
    }
}
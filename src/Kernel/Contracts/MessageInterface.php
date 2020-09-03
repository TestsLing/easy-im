<?php

namespace EasyIM\Kernel\Contracts;

interface MessageInterface
{
    public function getType(): string;

    public function transformToArray(array $appends = [], bool $isFlat = false): array;

    public function transformToJson(): string;
}

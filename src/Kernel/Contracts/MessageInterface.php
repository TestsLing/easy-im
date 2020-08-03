<?php


namespace EasyIM\Kernel\Contracts;


interface MessageInterface
{
    public function getType(): string;

    public function transformToArray(): array;

    public function transformToJson(): string;
}

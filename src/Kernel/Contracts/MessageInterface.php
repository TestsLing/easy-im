<?php

namespace EasyIM\Kernel\Contracts;

/**
 * Interface MessageInterface.
 */
interface MessageInterface
{
    public function getType(): string;

    public function transformForJsonRequest(): array;

    public function transformToXml(): string;
}

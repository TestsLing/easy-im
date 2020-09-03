<?php

namespace EasyIM\Kernel\Contracts;

interface ParameterInterface
{
    public function transformToArray(): array;

    public function transformParameterToArray(): array;
}

<?php

namespace EasyIM\Kernel;

class ParameterList extends Parameter
{
    public function __construct(Parameter ...$parameters)
    {
        parent::__construct($parameters);
    }

    public function __invoke()
    {
        return $this->transformParameterToArray();
    }
}

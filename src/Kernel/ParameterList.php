<?php


namespace EasyIM\Kernel;


class ParameterList extends Parameter
{
    private static $instance;

    private function __construct(Parameter ...$parameters)
    {
        parent::__construct($parameters);
    }

    private function __clone()
    {
        // TODO: Implement __clone() method.
    }

    public static function getInstance(Parameter ...$parameters)
    {
        if(!(self::$instance instanceof self)){
            self::$instance = new self(...$parameters);
        }
        return self::$instance->setAttributes($parameters);
    }


    public function __invoke()
    {
        return $this->transformParameterToArray();
    }
}

<?php


namespace EasyIM\TencentIM\Sns;


use EasyIM\Kernel\Exceptions\InvalidArgumentException;

class Friend
{
    /**
     *
     * @param $property
     *
     * @return mixed
     * @throws InvalidArgumentException
     */
    public function __get($property)
    {
        if (isset($this->app["sns.{$property}"])) {
            return $this->app["sns.{$property}"];
        }

        throw new InvalidArgumentException(sprintf('No Sns service named "%s".', $property));
    }
}

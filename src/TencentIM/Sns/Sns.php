<?php

namespace EasyIM\TencentIM\Sns;

use EasyIM\Kernel\Exceptions\InvalidArgumentException;

/**
 * Class Sns
 *
 * @package EasyIM\TencentIM\Sns
 * @author  longing <hacksmile@126.com>
 */
class Sns extends Client
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

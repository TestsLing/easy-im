<?php

namespace EasyIM\Kernel;

use EasyIM\Kernel\Contracts\ParameterInterface;
use EasyIM\Kernel\Traits\HasAttributes;

abstract class Parameter implements ParameterInterface
{
    use HasAttributes;

    /**
     * @var array
     */
    protected $properties = [];

    /**
     * Parameter constructor.
     *
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        $this->setAttributes($attributes);
    }

    /**
     *
     * @param array $appends
     *
     * @return array|array[]
     * @throws \EasyIM\Kernel\Exceptions\InvalidArgumentException
     */
    public function transformToArray(array $appends = []): array
    {
        return array_merge($this->propertiesToArray([]), $appends);
    }

    /**
     *
     * @return array
     */
    public function transformParameterToArray(): array
    {
        $attrs = [];

        foreach ($this->attributes as $parameter) {
            $attrs[] = $parameter->transformToArray();
        }

        return $attrs;
    }

    /**
     *
     * @param array $data
     *
     * @return array
     * @throws \EasyIM\Kernel\Exceptions\InvalidArgumentException
     */
    protected function propertiesToArray(array $data): array
    {
        $this->checkRequiredAttributes();

        foreach ($this->attributes as $property => $value) {
            if (is_null($value) && !$this->isRequired($property)) {
                continue;
            }

            $data[$property] = $this->get($property);
        }

        return $data;
    }
}

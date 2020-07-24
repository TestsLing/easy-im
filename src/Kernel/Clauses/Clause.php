<?php


namespace EasyIM\Kernel\Clauses;

/**
 * Class Clause.
 */
class Clause
{
    /**
     * @var array
     */
    protected $clauses = [
        'where' => [],
    ];

    /**
     * @param mixed ...$args
     *
     * @return $this
     */
    public function where(...$args)
    {
        array_push($this->clauses['where'], $args);

        return $this;
    }

    /**
     * @param mixed $payload
     *
     * @return bool
     */
    public function intercepted($payload)
    {
        return (bool) $this->interceptWhereClause($payload);
    }

    /**
     * @param mixed $payload
     *
     * @return bool
     */
    protected function interceptWhereClause($payload)
    {
        foreach ($this->clauses['where'] as $item) {
            list($key, $value) = $item;
            if (isset($payload[$key]) && $payload[$key] !== $value) {
                return true;
            }
        }
    }
}

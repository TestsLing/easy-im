<?php


namespace EasyIM\Kernel\Decorators;

/**
 * Class TerminateResult.
 */
class TerminateResult
{
    /**
     * @var mixed
     */
    public $content;

    /**
     * FinallyResult constructor.
     *
     * @param mixed $content
     */
    public function __construct($content)
    {
        $this->content = $content;
    }
}

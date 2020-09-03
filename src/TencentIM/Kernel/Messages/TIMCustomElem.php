<?php

namespace EasyIM\TencentIM\Kernel\Messages;

/**
 * Class TIMCustomElem
 *
 * @package EasyIM\TencentIM\Kernel\Messages
 * @author  longing <hacksmile@126.com>
 */
class TIMCustomElem extends Message
{
    /**
     * Message type.
     *
     * @var string
     */
    protected $type = 'TIMCustomElem';

    /**
     * Properties.
     *
     * @var array
     */
    protected $properties = [];


    public function __construct(string $Data)
    {
        parent::__construct(compact('Data'));
    }
}

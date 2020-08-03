<?php


namespace EasyIM\TencentIM\Kernel\Messages;


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

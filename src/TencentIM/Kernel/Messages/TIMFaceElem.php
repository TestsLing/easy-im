<?php


namespace EasyIM\TencentIM\Kernel\Messages;


class TIMFaceElem extends Message
{
    /**
     * Message type.
     *
     * @var string
     */
    protected $type = 'TIMFaceElem';

    /**
     * Properties.
     *
     * @var array
     */
    protected $properties = ['Index', 'Data'];

    public function __construct(string $Index, string $Data)
    {
        parent::__construct(compact('Index', 'Data'));
    }
}

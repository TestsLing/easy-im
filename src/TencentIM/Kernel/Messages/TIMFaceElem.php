<?php

namespace EasyIM\TencentIM\Kernel\Messages;

/**
 * Class TIMFaceElem
 *
 * @package EasyIM\TencentIM\Kernel\Messages
 * @author  longing <hacksmile@126.com>
 */
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

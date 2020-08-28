<?php


namespace EasyIM\TencentIM\Kernel\Messages;


/**
 * Class TIMTextElem
 *
 * @package EasyIM\TencentIM\Kernel\Messages
 * @author  longing <hacksmile@126.com>
 */
class TIMTextElem extends Message
{
    /**
     * Message type.
     *
     * @var string
     */
    protected $type = 'TIMTextElem';

    /**
     * Properties.
     *
     * @var array
     */
    protected $properties = ['Text'];

    /**
     * required attr
     *
     * @var array
     */
    protected $required = ['Text'];

    /**
     * TIMTextElem constructor.
     *
     * @param string $Text
     */
    public function __construct(string $Text)
    {
        parent::__construct(compact('Text'));
    }

}

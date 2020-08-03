<?php


namespace EasyIM\TencentIM\Kernel\Messages;


class TIMLocationElem extends Message
{
    /**
     * Message type.
     *
     * @var string
     */
    protected $type = 'TIMLocationElem';

    /**
     * Properties.
     *
     * @var array
     */
    protected $properties = ['Desc', 'Latitude', 'Longitude'];

    /**
     * required attr
     *
     * @var array
     */
//    protected $required = ['Text'];

    /**
     * TIMTextElem constructor.
     *
     * @param string $Text
     */
    public function __construct(string $Desc, float $Latitude, float $Longitude)
    {
        parent::__construct(compact('Desc', 'Latitude', 'Longitude'));
    }

}

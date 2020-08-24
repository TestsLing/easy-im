<?php


namespace EasyIM\TencentIM\Kernel\OfflinePushInfo;


use EasyIM\Kernel\Parameter;

/**
 * Class AndroidInfo
 *
 * @package EasyIM\TencentIM\Kernel\OfflinePushInfo
 * @author  longing <hacksmile@126.com>
 */
class AndroidInfo extends Parameter
{

    /**
     * @var string[]
     */
    protected $properties = [
        'Sound',
        'OPPOChannelID',
    ];


    /**
     *
     * @param string $value
     *
     * @return $this
     */
    public function setSound(string $value)
    {
        $this->setAttribute('Sound', $value);
        return $this;
    }

    /**
     *
     * @param string $value
     *
     * @return $this
     */
    public function setOPPOChannelID(string $value)
    {
        $this->setAttribute('OPPOChannelID', $value);
        return $this;
    }

}

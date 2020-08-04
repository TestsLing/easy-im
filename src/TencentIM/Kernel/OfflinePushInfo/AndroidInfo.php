<?php


namespace EasyIM\TencentIM\Kernel\OfflinePushInfo;


use EasyIM\TencentIM\Kernel\Messages\Message;

/**
 * Class AndroidInfo
 *
 * @package EasyIM\TencentIM\Kernel\OfflinePushInfo
 * @author  longing <hacksmile@126.com>
 */
class AndroidInfo extends Message
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
     * @param array $appends
     * @param bool  $isFlat
     *
     * @return array
     * @throws \EasyIM\Kernel\Exceptions\InvalidArgumentException
     */
    public function transformToArray(array $appends = [], bool $isFlat = false): array
    {
        return $this->propertiesToArray($appends);
    }

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

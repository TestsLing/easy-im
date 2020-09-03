<?php

namespace EasyIM\TencentIM\Kernel\OfflinePushInfo;

use EasyIM\Kernel\Parameter;

/**
 * Class ApnsInfo
 *
 * @package EasyIM\TencentIM\Kernel\OfflinePushInfo
 * @author  longing <hacksmile@126.com>
 */
class ApnsInfo extends Parameter
{
    /**
     * @var string[]
     */
    protected $properties = [
        'Sound',
        'BadgeMode',
        'Title',
        'SubTitle',
        'Image'
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
     * @param int $value
     *
     * @return $this
     */
    public function setBadgeMode(int $value)
    {
        $this->setAttribute('BadgeMode', $value);
        return $this;
    }

    /**
     *
     * @param string $value
     *
     * @return $this
     */
    public function setTitle(string $value)
    {
        $this->setAttribute('Title', $value);
        return $this;
    }

    /**
     *
     * @param string $value
     *
     * @return $this
     */
    public function setSubTitle(string $value)
    {
        $this->setAttribute('SubTitle', $value);
        return $this;
    }

    /**
     *
     * @param string $value
     *
     * @return $this
     */
    public function setImage(string $value)
    {
        $this->setAttribute('Image', $value);
        return $this;
    }
}

<?php

namespace EasyIM\TencentIM\Kernel\OfflinePushInfo;

use EasyIM\Kernel\Parameter;

/**
 * Class OfflinePushElem
 *
 * @package EasyIM\TencentIM\Kernel\OfflinePushInfo
 * @author  longing <hacksmile@126.com>
 */
class OfflinePushElem extends Parameter
{
    protected $properties = [
        'PushFlag',
        'Title',
        'Desc',
        'Ext',
        'AndroidInfo',
        'ApnsInfo'
    ];

    /**
     *
     * @param int $value 0 or 1
     *
     * @return $this
     */
    public function setPushFlag(int $value)
    {
        $this->setAttribute('PushFlag', $value);
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
    public function setDesc(string $value)
    {
        $this->setAttribute('Desc', $value);
        return $this;
    }

    /**
     *
     * @param string $value
     *
     * @return $this
     */
    public function setExt(string $value)
    {
        $this->setAttribute('Ext', $value);
        return $this;
    }

    /**
     *
     * @param AndroidInfo $androidInfo
     *
     * @return $this
     * @throws \EasyIM\Kernel\Exceptions\InvalidArgumentException
     */
    public function setAndroidInfo(AndroidInfo $androidInfo)
    {
        $this->setAttribute('AndroidInfo', $androidInfo->transformToArray());
        return $this;
    }


    /**
     *
     * @param ApnsInfo $apnsInfo
     *
     * @return $this
     * @throws \EasyIM\Kernel\Exceptions\InvalidArgumentException
     */
    public function setApnsInfo(ApnsInfo $apnsInfo)
    {
        $this->setAttribute('ApnsInfo', $apnsInfo->transformToArray());
        return $this;
    }
}

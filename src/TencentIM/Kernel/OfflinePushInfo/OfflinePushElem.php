<?php


namespace EasyIM\TencentIM\Kernel\OfflinePushInfo;


use EasyIM\TencentIM\Kernel\Messages\Message;

/**
 * Class OfflinePushElem
 *
 * @package EasyIM\TencentIM\Kernel\OfflinePushInfo
 * @author  longing <hacksmile@126.com>
 */
class OfflinePushElem extends Message
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
     * @param Message $androidInfo
     *
     * @return $this
     * @throws \EasyIM\Kernel\Exceptions\InvalidArgumentException
     */
    public function setAndroidInfo(Message $androidInfo)
    {
        $this->setAttribute('AndroidInfo', $androidInfo->transformToArray());
        return $this;
    }


    /**
     *
     * @param Message $apnsInfo
     *
     * @return $this
     * @throws \EasyIM\Kernel\Exceptions\InvalidArgumentException
     */
    public function setApnsInfo(Message $apnsInfo)
    {
        $this->setAttribute('ApnsInfo', $apnsInfo->transformToArray());
        return $this;
    }


}

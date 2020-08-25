<?php


namespace EasyIM\TencentIM\Group\Parameter\Import;


use EasyIM\Kernel\Contracts\MessageInterface;
use EasyIM\Kernel\Parameter;

class ImportMsgListParameter extends Parameter
{
    /**
     * @var array
     */
    protected $properties = [
        'From_Account',
        'SendTime',
        'MsgBody',
    ];

    protected $required = ['From_Account', 'SendTime', 'MsgBody'];

    /**
     *
     * @param string $value
     *
     * @return $this
     */
    public function setFromAccount(string $value)
    {
        $this->setAttribute('From_Account', $value);

        return $this;
    }

    /**
     *
     * @param int $value
     *
     * @return $this
     */
    public function setSendTime(int $value)
    {
        $this->setAttribute('SendTime', $value);

        return $this;
    }


    /**
     *
     * @param string $value
     *
     * @return $this
     */
    public function setRandom(string $value)
    {
        $this->setAttribute('Random', $value);

        return $this;
    }

    /**
     *
     * @param MessageInterface ...$value
     *
     * @return $this
     */
    public function setMsgBody(MessageInterface ...$value)
    {
        $items = [];

        foreach ($value as $item) {
            $items[] = $item->transformToArray([], true);
        }

        $this->setAttribute('MsgBody', $items);

        return $this;
    }

    public function transformToArray(array $appends = []): array
    {
        return parent::transformToArray(['Random' => mt_rand(1, 99999999)]);
    }
}
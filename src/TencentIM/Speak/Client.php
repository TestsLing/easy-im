<?php

namespace EasyIM\TencentIM\Speak;

use EasyIM\Kernel\BaseClient;

/**
 * Class Client
 *
 * @package EasyIM\TencentIM\Speak
 * @author  longing <hacksmile@126.com>
 */
class Client extends BaseClient
{
    /**
     *
     * Query user forbidden words.
     *
     * @param string $account
     *
     * @return array|\EasyIM\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     * @throws \EasyIM\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getGlobalNoSpeaking(string $account)
    {
        $params = [
            'Get_Account' => $account
        ];

        return $this->httpPostJson('openconfigsvr/getnospeaking', $params);
    }

    /**
     * Set user forbidden words.
     *
     * @param string $account
     * @param int    $c2cMsgNoSpeakingTime
     * @param int    $groupMsgNoSpeakingTime
     *
     * @return array|\EasyIM\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     * @throws \EasyIM\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function setGlobalNoSpeaking(string $account, int $c2cMsgNoSpeakingTime = 0, int $groupMsgNoSpeakingTime = 0)
    {
        $params = [
            'Set_Account' => $account,
            'C2CmsgNospeakingTime' => $c2cMsgNoSpeakingTime,
            'GroupmsgNospeakingTime' => $groupMsgNoSpeakingTime,
        ];

        return $this->httpPostJson('openconfigsvr/setnospeaking', $params);
    }
}

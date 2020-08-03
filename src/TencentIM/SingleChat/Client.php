<?php

namespace EasyIM\TencentIM\SingleChat;

use EasyIM\TencentIM\Kernel\IMBaseClient;


/**
 * Class Client.
 */
class Client extends IMBaseClient
{

    /**
     * Send single message
     *
     * @param array $accounts
     * @param array $tags
     *
     * @return array|\EasyIM\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     * @throws \EasyIM\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function sendMsg(array $accounts, array $tags)
    {
        $params = [
            'To_Account' => $accounts,
            'TagList' => $tags,
        ];

        return $this->httpPostJson('openim/sendmsg', $params);
    }

    /**
     * Batch send single chat.
     *
     * @param array $accounts
     * @param array $tags
     *
     * @return array|\EasyIM\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     * @throws \EasyIM\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function batchSendMsg(array $accounts, array $tags)
    {
        $params = [
            'To_Account' => $accounts,
            'TagList' => $tags,
        ];

        return $this->httpPostJson('openim/batchsendmsg', $params);
    }


    /**
     *
     * Import single chat message.
     *
     * @param array $accounts
     * @param array $tags
     *
     * @return array|\EasyIM\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     * @throws \EasyIM\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function importMsg(array $accounts, array $tags)
    {
        $params = [
            'To_Account' => $accounts,
            'TagList' => $tags,
        ];

        return $this->httpPostJson('openim/importmsg', $params);
    }


    /**
     * Query single chat message.
     *
     * @param array $accounts
     * @param array $tags
     *
     * @return array|\EasyIM\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     * @throws \EasyIM\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function queryMsg(string $fromAccount, string $toAccount, int $maxcnt, int $minTime, int $maxTime, string $lastMsgKey = null)
    {
        $params = [
            'From_Account' => $fromAccount,
            'To_Account' => $toAccount,
            'MaxCnt' => $maxcnt,
            'MinTime' => $minTime,
            'MaxTime' => $maxTime,
        ];

        $lastMsgKey && $params['LastMsgKey'] = $lastMsgKey;

        return $this->httpPostJson('openim/admin_getroammsg', $params);
    }

    /**
     * Withdraw single chat message.
     *
     * @param string $fromAccount
     * @param string $toAccount
     * @param string $msgKey
     *
     * @return array|\EasyIM\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     * @throws \EasyIM\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function withdrawMsg(string $fromAccount, string $toAccount, string $msgKey)
    {
        $params = [
            'From_Account' => $fromAccount,
            'To_Account' => $toAccount,
            'MsgKey' => $msgKey,
        ];

        return $this->httpPostJson('openim/admin_msgwithdraw', $params);
    }



}

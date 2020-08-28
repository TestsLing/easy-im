<?php

namespace EasyIM\TencentIM\Operate;

use EasyIM\Kernel\BaseClient;

/**
 * Class Client.
 */
class Client extends BaseClient
{

    /**
     *
     * Pull operation data.
     *
     * @param array $fields 指定拉取的字段
     *
     * @return array|\EasyIM\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     * @throws \EasyIM\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getAppInfo(array $fields = [])
    {
        $params = count($fields) > 0 ? ['RequestField' => $fields] : $fields;

        return $this->httpPostJson('openconfigsvr/getappinfo', $params);
    }

    /**
     * Download recent message log.
     *
     * @param string $chatType C2C or Group
     * @param string $megTime
     *
     * @return array|\EasyIM\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     * @throws \EasyIM\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getHistory(string $megTime, string $chatType = 'C2C')
    {
        $params = [
            'ChatType' => $chatType,
            'MsgTime'  => $megTime
        ];

        return $this->httpPostJson('open_msg_svc/get_history', $params);
    }

    /**
     * Get server IP address.
     * @return array|\EasyIM\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     * @throws \EasyIM\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getIPList()
    {
        return $this->httpPostJson('ConfigSvc/GetIPList');
    }
}

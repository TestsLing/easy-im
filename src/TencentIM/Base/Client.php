<?php

namespace EasyIM\TencentIM\Base;

use EasyIM\Kernel\BaseClient;
use EasyIM\Kernel\Exceptions\InvalidArgumentException;

/**
 * Class Client.
 */
class Client extends BaseClient
{
    /**
     * Clear quota.
     *
     * @return \Psr\Http\Message\ResponseInterface|\EasyIM\Kernel\Support\Collection|array|object|string
     *
     * @throws \EasyIM\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function clearQuota()
    {
        $params = [
            'appid' => $this->app['config']['app_id'],
        ];

        return $this->httpPostJson('cgi-bin/clear_quota', $params);
    }

    /**
     * Get wechat callback ip.
     *
     * @return \Psr\Http\Message\ResponseInterface|\EasyIM\Kernel\Support\Collection|array|object|string
     *
     * @throws \EasyIM\Kernel\Exceptions\InvalidConfigException
     */
    public function getValidIps()
    {
        return $this->httpGet('cgi-bin/getcallbackip');
    }

    /**
     * Check the callback address network.
     *
     * @param string $action
     * @param string $operator
     *
     * @return array|\EasyIM\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     *
     * @throws InvalidArgumentException
     * @throws \EasyIM\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function checkCallbackUrl(string $action = 'all', string $operator = 'DEFAULT')
    {
        if (!in_array($action, ['dns', 'ping', 'all'], true)) {
            throw new InvalidArgumentException('The action must be dns, ping, all.');
        }

        $operator = strtoupper($operator);

        if (!in_array($operator, ['CHINANET', 'UNICOM', 'CAP', 'DEFAULT'], true)) {
            throw new InvalidArgumentException('The operator must be CHINANET, UNICOM, CAP, DEFAULT.');
        }

        $params = [
            'action' => $action,
            'check_operator' => $operator,
        ];

        return $this->httpPostJson('cgi-bin/callback/check', $params);
    }
}

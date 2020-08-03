<?php


namespace EasyIM\TencentIM\Kernel;

use EasyIM\Kernel\BaseClient;

class IMBaseClient extends BaseClient
{

    public function httpPostJson(string $url, array $data = [], array $query = [])
    {
        return parent::httpPostJson($url, $data, array_merge($this->genQueryParam(), $query));
    }


    public function genQueryParam()
    {
        $sign = $this->app['sign']->genSig($this->app['config']['identifier']);

        return [
            'usersig' => $sign,
            'random' => mt_rand(1, 99999999),
            'sdkappid' => $this->app['config']['sdk_app_id'],
            'identifier' => $this->app['config']['identifier'],
            'contenttype' => 'json'
        ];
    }
}

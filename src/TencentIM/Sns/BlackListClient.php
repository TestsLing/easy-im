<?php


namespace EasyIM\TencentIM\Sns;


use EasyIM\TencentIM\Kernel\IMBaseClient;

class BlackListClient extends IMBaseClient
{


    /**
     *
     * @param string $fromAccount
     * @param array  $toAccount
     *
     * @return array|\EasyIM\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     * @throws \EasyIM\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function add(string $fromAccount, array $toAccount)
    {
        $params = [
            'From_Account' => $fromAccount,
            'To_Account' => $toAccount
        ];

        return $this->httpPostJson('sns/black_list_add', $params);
    }

    /**
     *
     * @param string $fromAccount
     * @param array  $toAccount
     *
     * @return array|\EasyIM\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     * @throws \EasyIM\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function del(string $fromAccount, array $toAccount)
    {
        $params = [
            'From_Account' => $fromAccount,
            'To_Account' => $toAccount
        ];

        return $this->httpPostJson('sns/black_list_delete', $params);
    }


    /**
     *
     * @param string $fromAccount
     * @param int    $startIndex
     * @param int    $maxLimited
     * @param int    $lastSequence
     *
     * @return array|\EasyIM\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     * @throws \EasyIM\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function pull(string $fromAccount, int $startIndex = 0, int $maxLimited = 20, int $lastSequence = 0)
    {
        $params = [
            'From_Account' => $fromAccount,
            'StartIndex' => $startIndex,
            'MaxLimited' => $maxLimited,
            'LastSequence' => $lastSequence
        ];

        return $this->httpPostJson('sns/black_list_get', $params);
    }


    /**
     *
     * @param string $fromAccount
     * @param array  $toAccount
     * @param string $checkType type detail https://cloud.tencent.com/document/product/269/1501#.E6.A0.A1.E9.AA.8C.E9.BB.91.E5.90.8D.E5.8D.95
     *
     * @return array|\EasyIM\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     * @throws \EasyIM\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function check(string $fromAccount, array $toAccount, string $checkType = 'BlackCheckResult_Type_Both')
    {
        $params = [
            'From_Account' => $fromAccount,
            'To_Account' => $toAccount,
            'CheckType' => $checkType
        ];

        return $this->httpPostJson('sns/black_list_check', $params);
    }

}

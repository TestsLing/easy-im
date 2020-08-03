<?php

namespace EasyIM\TencentIM\Profile;

use EasyIM\TencentIM\Kernel\IMBaseClient;


/**
 * Class Client.
 */
class Client extends IMBaseClient
{


    /**
     * Get User Profile.
     *
     * @param array $accounts
     * @param array $tags
     *
     * @return array|\EasyIM\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     * @throws \EasyIM\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getPortrait(array $accounts, array $tags)
    {
        $params = [
            'To_Account' => $accounts,
            'TagList' => $tags,
        ];

        return $this->httpPostJson('profile/portrait_get', $params);
    }

    /**
     *  Set User Profile.
     *
     * @param string $account
     * @param string $tag
     * @param  $value
     *
     * @return array|\EasyIM\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     * @throws \EasyIM\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function setPortrait(string $account, string $tag, $value)
    {
        $params = [
            'From_Account' => $account,
            'ProfileItem' => [
                [
                    'Tag' => $tag,
                    'Value' => $value,
                ],
            ],
        ];

        return $this->httpPostJson('profile/portrait_set', $params);
    }

}

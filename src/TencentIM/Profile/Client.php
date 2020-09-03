<?php

namespace EasyIM\TencentIM\Profile;

use EasyIM\Kernel\BaseClient;
use EasyIM\TencentIM\Kernel\Parameter\TagParameter;

/**
 * Class Client
 *
 * @package EasyIM\TencentIM\Profile
 * @author  longing <hacksmile@126.com>
 */
class Client extends BaseClient
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
     * Set User Profile.
     *
     * @param string       $account
     * @param TagParameter ...$tagParameters
     *
     * @return array|\EasyIM\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     * @throws \EasyIM\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function setPortrait(string $account, TagParameter ...$tagParameters)
    {
        $params = [
            'From_Account' => $account,
            'ProfileItem' => parameterList(...$tagParameters)()
        ];

        return $this->httpPostJson('profile/portrait_set', $params);
    }
}

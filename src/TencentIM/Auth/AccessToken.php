<?php

namespace EasyIM\TencentIM\Auth;

use EasyIM\Kernel\AccessToken as BaseAccessToken;
use EasyIM\Kernel\Events\AccessTokenRefreshed;
use Psr\Http\Message\RequestInterface;

/**
 * Class AccessToken
 *
 * @package EasyIM\TencentIM\Auth
 * @author  longing <hacksmile@126.com>
 */
class AccessToken extends BaseAccessToken
{
    /**
     * @var string
     */
    protected $tokenKey = 'usersig';

    /**
     * @var string
     */
    protected $cachePrefix = 'EasyIM.kernel.usersig.';

    /**
     * @param bool $refresh
     *
     * @return array
     *
     * @throws \EasyIM\Kernel\Exceptions\HttpException
     * @throws \Psr\SimpleCache\InvalidArgumentException
     * @throws \EasyIM\Kernel\Exceptions\InvalidConfigException
     * @throws \EasyIM\Kernel\Exceptions\InvalidArgumentException
     * @throws \EasyIM\Kernel\Exceptions\RuntimeException
     */
    public function getToken(bool $refresh = false): array
    {
        $cacheKey = $this->getCacheKey();
        $cache = $this->getCache();

        if (!$refresh && $cache->has($cacheKey)) {
            $sign = $cache->get($cacheKey);
            if ($this->verifySig($sign)) {
                return $sign;
            }
        }

        /** @var array $token */
        $token = $this->requestToken();

        $this->setToken($token[$this->tokenKey], $token['expires_in'] ?? 7200);

        $this->app->events->dispatch(new AccessTokenRefreshed($this));

        return $token;
    }

    /**
     * verifySig
     *
     * @param $sign
     *
     * @return mixed
     */
    public function verifySig($sign)
    {
        $tLSSigAPIv2 = $this->app['sign'];
        $identifier = $this->app['config']['identifier'];

        return $tLSSigAPIv2->verifySig($sign[$this->tokenKey], $identifier, $initTime, $expireTime, $errorMsg);
    }

    /**
     *
     * @param RequestInterface $request
     * @param array            $requestOptions
     *
     * @return RequestInterface
     * @throws \EasyIM\Kernel\Exceptions\HttpException
     * @throws \EasyIM\Kernel\Exceptions\InvalidArgumentException
     * @throws \EasyIM\Kernel\Exceptions\InvalidConfigException
     * @throws \EasyIM\Kernel\Exceptions\RuntimeException
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    public function applyToRequest(RequestInterface $request, array $requestOptions = []): RequestInterface
    {
        parse_str($request->getUri()->getQuery(), $query);

        $query = http_build_query(array_merge(
            $this->getQuery(),
            $query,
            $this->getCredentials(),
            ['random' => mt_rand(1, 99999999)]
        ));

        return $request->withUri($request->getUri()->withQuery($query));
    }

    /**
     * requestToken
     *
     * @return array
     */
    public function requestToken(): array
    {
        $tLSSigAPIv2 = $this->app['sign'];
        $identifier = $this->app['config']['identifier'];
        $expire = $this->app['config']['expire'] ?? 86400 * 2;

        return [
            $this->queryName ?? $this->tokenKey => $tLSSigAPIv2->genSig($identifier, $expire),
            'expires_in' => $expire
        ];
    }

    /**
     * @return array
     */
    protected function getCredentials(): array
    {
        return [
            'sdkappid' => $this->app['config']['sdk_app_id'],
            'identifier' => $this->app['config']['identifier'],
            'contenttype' => 'json'
        ];
    }
}

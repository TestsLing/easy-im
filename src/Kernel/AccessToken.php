<?php

/*
 * This file is part of the overtrue/wechat.
 *
 * (c) overtrue <i@overtrue.me>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace EasyIM\Kernel;

use EasyIM\Kernel\Contracts\AccessTokenInterface;
use EasyIM\Kernel\Exceptions\RuntimeException;
use EasyIM\Kernel\Traits\HasHttpRequests;
use EasyIM\Kernel\Traits\InteractsWithCache;
use Psr\Http\Message\RequestInterface;

/**
 * Class AccessToken.
 *
 * @author overtrue <i@overtrue.me>
 */
abstract class AccessToken implements AccessTokenInterface
{
    use HasHttpRequests;
    use InteractsWithCache;

    /**
     * @var \EasyIM\Kernel\ServiceContainer
     */
    protected $app;

    /**
     * @var string
     */
    protected $queryName;

    /**
     * @var array
     */
    protected $token;

    /**
     * @var string
     */
    protected $tokenKey = 'access_token';

    /**
     * @var string
     */
    protected $cachePrefix = 'EasyIM.kernel.access_token.';

    /**
     * AccessToken constructor.
     *
     * @param \EasyIM\Kernel\ServiceContainer $app
     */
    public function __construct(ServiceContainer $app)
    {
        $this->app = $app;
    }

    /**
     * @return array
     *
     * @throws \EasyIM\Kernel\Exceptions\HttpException
     * @throws \Psr\SimpleCache\InvalidArgumentException
     * @throws \EasyIM\Kernel\Exceptions\InvalidConfigException
     * @throws \EasyIM\Kernel\Exceptions\InvalidArgumentException
     * @throws \EasyIM\Kernel\Exceptions\RuntimeException
     */
    public function getRefreshedToken(): array
    {
        return $this->getToken(true);
    }

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
            return $cache->get($cacheKey);
        }

        /** @var array $token */
        $token = $this->requestToken();


        $this->setToken($token[$this->tokenKey], $token['expires_in']);

        $this->app->events->dispatch(new Events\AccessTokenRefreshed($this));

        return $token;
    }

    /**
     * @param string $token
     * @param int    $lifetime
     *
     * @return \EasyIM\Kernel\Contracts\AccessTokenInterface
     *
     * @throws \EasyIM\Kernel\Exceptions\InvalidArgumentException
     * @throws \EasyIM\Kernel\Exceptions\RuntimeException
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    public function setToken(string $token, int $lifetime = 7200): AccessTokenInterface
    {
        $this->getCache()->set($this->getCacheKey(), [
            $this->tokenKey => $token,
            'expires_in' => $lifetime,
        ], $lifetime);

        if (!$this->getCache()->has($this->getCacheKey())) {
            throw new RuntimeException('Failed to cache access token.');
        }

        return $this;
    }

    /**
     * @return \EasyIM\Kernel\Contracts\AccessTokenInterface
     *
     * @throws \EasyIM\Kernel\Exceptions\HttpException
     * @throws \Psr\SimpleCache\InvalidArgumentException
     * @throws \EasyIM\Kernel\Exceptions\InvalidConfigException
     * @throws \EasyIM\Kernel\Exceptions\InvalidArgumentException
     * @throws \EasyIM\Kernel\Exceptions\RuntimeException
     */
    public function refresh(): AccessTokenInterface
    {
        $this->getToken(true);

        return $this;
    }

    /**
     *
     * @return array
     */
    abstract public function requestToken(): array;

    /**
     * @param \Psr\Http\Message\RequestInterface $request
     * @param array                              $requestOptions
     *
     * @return \Psr\Http\Message\RequestInterface
     *
     * @throws \EasyIM\Kernel\Exceptions\HttpException
     * @throws \Psr\SimpleCache\InvalidArgumentException
     * @throws \EasyIM\Kernel\Exceptions\InvalidConfigException
     * @throws \EasyIM\Kernel\Exceptions\InvalidArgumentException
     * @throws \EasyIM\Kernel\Exceptions\RuntimeException
     */
    abstract public function applyToRequest(RequestInterface $request, array $requestOptions = []): RequestInterface;

    /**
     * @return string
     */
    protected function getCacheKey()
    {
        return $this->cachePrefix.md5(json_encode($this->getCredentials()));
    }

    /**
     * The request query will be used to add to the request.
     *
     * @return array
     *
     * @throws \EasyIM\Kernel\Exceptions\HttpException
     * @throws \Psr\SimpleCache\InvalidArgumentException
     * @throws \EasyIM\Kernel\Exceptions\InvalidConfigException
     * @throws \EasyIM\Kernel\Exceptions\InvalidArgumentException
     * @throws \EasyIM\Kernel\Exceptions\RuntimeException
     */
    protected function getQuery(): array
    {
        return [$this->queryName ?? $this->tokenKey => $this->getToken()[$this->tokenKey]];
    }


    /**
     * @return string
     */
    public function getTokenKey()
    {
        return $this->tokenKey;
    }

    /**
     * Credential for get token.
     *
     * @return array
     */
    abstract protected function getCredentials(): array;
}

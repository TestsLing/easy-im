<?php

namespace EasyTM\Tests\Kernel;

use EasyIM\Kernel\AccessToken;
use EasyIM\Kernel\Exceptions\RuntimeException;
use EasyIM\Kernel\ServiceContainer;
use PHPUnit\Framework\TestCase;
use Psr\SimpleCache\CacheInterface;
use Symfony\Component\Cache\Adapter\ArrayAdapter;

class AccessTokenTest extends TestCase
{
    public function testCache()
    {
        $app = \Mockery::mock(ServiceContainer::class)->makePartial();
        $token = \Mockery::mock(AccessToken::class, [$app])->makePartial();

        self::assertInstanceOf(CacheInterface::class, $token->getCache());

        // prepended cache instance
        if (\class_exists('Symfony\Component\Cache\Psr16Cache')) {
            $cache = new ArrayAdapter();
        } else {
            $cache = new FilesystemCache();
        }

        $app['cache'] = function () use ($cache) {
            return $cache;
        };
        $token = \Mockery::mock(AccessToken::class, [$app])->makePartial();

        self::assertInstanceOf(CacheInterface::class, $token->getCache());
    }

    public function testSetToken()
    {
        $app = \Mockery::mock(ServiceContainer::class)->makePartial()->shouldAllowMockingProtectedMethods();
        $cache = \Mockery::mock(CacheInterface::class);
        $token = \Mockery::mock(AccessToken::class.'[getCacheKey,getCache]', [$app])
            ->shouldAllowMockingProtectedMethods();
        $token->allows()->getCacheKey()->andReturn('mock-cache-key');
        $token->allows()->getCache()->andReturn($cache);

        $cache->expects()->has('mock-cache-key')->andReturn(true);
        $cache->expects()->set('mock-cache-key', [
            'access_token' => 'mock-token',
            'expires_in' => 7200,
        ], 7200)->andReturn(true);
        $result = $token->setToken('mock-token');
        $this->assertSame($token, $result);

        // 7000
        $cache->expects()->has('mock-cache-key')->andReturn(true);
        $cache->expects()->set('mock-cache-key', [
            'access_token' => 'mock-token',
            'expires_in' => 7000,
        ], 7000)->andReturn(true);
        $result = $token->setToken('mock-token', 7000);
        $this->assertSame($token, $result);

        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage('Failed to cache access token.');
        $cache->expects()->has('mock-cache-key')->andReturn(false);
        $cache->expects()->set('mock-cache-key', [
            'access_token' => 'mock-token',
            'expires_in' => 7000,
        ], 7000)->andReturn(false);
        $token->setToken('mock-token', 7000);
    }

    public function testRefresh()
    {
        $app = \Mockery::mock(ServiceContainer::class);
        $token = \Mockery::mock(AccessToken::class.'[getToken]', [$app])
            ->shouldAllowMockingProtectedMethods();
        $token->expects()->getToken(true);

        $result = $token->refresh();

        $this->assertSame($token, $result);
    }

    public function testGetCacheKey()
    {
        $app = \Mockery::mock(ServiceContainer::class)->makePartial();
        $token = \Mockery::mock(AccessToken::class.'[getCacheKey,getCredentials]', [$app])
            ->shouldAllowMockingProtectedMethods();
        $credentials = [
            'appid' => '123',
            'secret' => 'pa33w0rd',
        ];
        $token->allows()->getCredentials()->andReturn($credentials);
        $token->expects()->getCacheKey()->passthru();

        $this->assertStringEndsWith(md5(json_encode($credentials)), $token->getCacheKey());
    }
}

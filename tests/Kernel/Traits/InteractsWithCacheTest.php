<?php

namespace EasyTM\Tests\Kernel\Traits;

use EasyIM\Kernel\Exceptions\InvalidArgumentException;
use EasyIM\Kernel\Traits\InteractsWithCache;
use PHPUnit\Framework\TestCase;
use Psr\SimpleCache\CacheInterface;
use Symfony\Component\Cache\Adapter\NullAdapter;
use Symfony\Component\Cache\Psr16Cache;

class InteractsWithCacheTest extends TestCase
{
    public function testBasicFeatures()
    {
        $trait = \Mockery::mock(InteractsWithCache::class);
        self::assertInstanceOf(CacheInterface::class, $trait->getCache());

        $cache = \Mockery::mock(CacheInterface::class);
        $trait->setCache($cache);
        self::assertSame($cache, $trait->getCache());

        if (\class_exists('Symfony\Component\Cache\Psr16Cache')) {
            self::doTestPsr6Bridge();
        }
    }

    /**
     * @return mixed
     *
     * @throws InvalidArgumentException
     */
    public function doTestPsr6Bridge()
    {
        $trait = \Mockery::mock(InteractsWithCache::class);

        self::assertInstanceOf(Psr16Cache::class, $trait->getCache());

        $psr6Cache = new NullAdapter();

        $trait->setCache($psr6Cache);

        self::assertInstanceOf(CacheInterface::class, $trait->getCache());

        // invalid instance
        self::expectException(InvalidArgumentException::class);
        self::expectExceptionMessage('The cache instance must implements Psr\SimpleCache\CacheInterface or Psr\Cache\CacheItemPoolInterface interface.');

        $trait->setCache(new \stdClass());
    }
}

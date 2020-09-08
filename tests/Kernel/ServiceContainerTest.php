<?php

namespace EasyTM\Tests\Kernel;

use EasyIM\Kernel\BaseClient;
use EasyIM\Kernel\Config;
use EasyIM\Kernel\Log\LogManager;
use EasyIM\Kernel\ServiceContainer;
use EasyWeChatComposer\Delegation\DelegationTo;
use GuzzleHttp\Client;
use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Symfony\Component\HttpFoundation\Request;
use PHPUnit\Framework\TestCase;

class ServiceContainerTest extends TestCase
{
    public function testBasicFeatures()
    {
        $container = new ServiceContainer();

        self::assertNotEmpty($container->getProviders());

        // __set, __get, offsetGet
        self::assertInstanceOf(Config::class, $container['config']);
        self::assertInstanceOf(Config::class, $container->config);

        self::assertInstanceOf(Client::class, $container['http_client']);
        self::assertInstanceOf(Request::class, $container['request']);
        self::assertInstanceOf(LogManager::class, $container['log']);
        self::assertInstanceOf(LogManager::class, $container['logger']);

        $container['foo'] = 'foo';
        $container->bar = 'bar';

        self::assertSame('foo', $container['foo']);
        self::assertSame('bar', $container['bar']);
    }

    public function testGetId()
    {
        self::assertSame(
            (new ServiceContainer(['app_id' => 'app-id1']))->getId(),
            (new ServiceContainer(['app_id' => 'app-id1']))->getId()
        );
        self::assertNotSame(
            (new ServiceContainer(['app_id' => 'app-id1']))->getId(),
            (new ServiceContainer(['app_id' => 'app-id2']))->getId()
        );
    }

    public function testRegisterProviders()
    {
        $container = new DummyContainerForProviderTest();

        self::assertSame('foo', $container['foo']);
    }

    public function testMagicGetDelegation()
    {
        $container = \Mockery::mock(ServiceContainer::class);

        $container->shouldReceive('delegateTo')->andReturn(DelegationTo::class);
        $container->shouldReceive('offsetGet')->andReturn(BaseClient::class);
        $container->shouldReceive('shouldDelegate')->andReturn(true, false);

        self::assertSame(DelegationTo::class, $container->log);
        self::assertSame(BaseClient::class, $container->config);
    }
}

class DummyContainerForProviderTest extends ServiceContainer
{
    protected $providers = [
        FooServiceProvider::class,
    ];
}
class FooServiceProvider implements ServiceProviderInterface
{
    public function register(Container $pimple)
    {
        $pimple['foo'] = function () {
            return 'foo';
        };
    }
}

<?php

namespace EasyTM\Tests\Kernel\Traits;

use EasyIM\Kernel\Http\Response;
use EasyIM\Kernel\Traits\HasHttpRequests;
use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\HandlerStack;
use PHPUnit\Framework\TestCase;

class HasHttpRequestsTest extends TestCase
{
    public function testDefaultOptions()
    {
        self::assertSame([
            'curl' => [
                CURLOPT_IPRESOLVE => CURL_IPRESOLVE_V4,
            ],
        ], HasHttpRequests::getDefaultOptions());

        HasHttpRequests::setDefaultOptions(['foo' => 'bar']);

        self::assertSame(['foo' => 'bar'], HasHttpRequests::getDefaultOptions());
    }

    public function testHttpClient()
    {
        $cls = \Mockery::mock(HasHttpRequests::class);
        self::assertInstanceOf(ClientInterface::class, $cls->getHttpClient());

        $client = \Mockery::mock(Client::class);
        $cls->setHttpClient($client);
        self::assertSame($client, $cls->getHttpClient());
    }

    public function testMiddlewareFeatures()
    {
        $cls = \Mockery::mock(HasHttpRequests::class);
        self::assertEmpty($cls->getMiddlewares());

        $fn1 = function () {
        };
        $fn2 = function () {
        };
        $fn3 = function () {
        };

        $cls->pushMiddleware($fn1, 'fn1');
        $cls->pushMiddleware($fn2, 'fn2');
        $cls->pushMiddleware($fn3);

        self::assertSame(['fn1' => $fn1, 'fn2' => $fn2, $fn3], $cls->getMiddlewares());
    }

    public function testRequest()
    {
        $cls = \Mockery::mock(DummnyClassForHasHttpRequestTest::class.'[getHandlerStack]');
        $handlerStack = \Mockery::mock(HandlerStack::class);
        $cls->allows()->getHandlerStack()->andReturn($handlerStack);

        $client = \Mockery::mock(Client::class);
        $cls->setHttpClient($client);

        $response = new Response(200, [], 'mock-result');

        // default arguments
        $client->expects()->request('GET', 'foo/bar', [
            'curl' => [
                CURLOPT_IPRESOLVE => CURL_IPRESOLVE_V4,
            ],
            'handler' => $handlerStack,
            'base_uri' => 'http://easyim.cn',
        ])->andReturn($response);

        self::assertSame($response, $cls->request('foo/bar'));

        // custom arguments
        $client->expects()->request('POST', 'foo/bar', [
            'curl' => [
                CURLOPT_IPRESOLVE => CURL_IPRESOLVE_V4,
            ],
            'query' => ['foo' => 'bar'],
            'handler' => $handlerStack,
            'base_uri' => 'http://easyim.cn',
        ])->andReturn($response);

        self::assertSame($response, $cls->request('foo/bar', 'post', ['query' => ['foo' => 'bar']]));
    }

    public function testHandlerStack()
    {
        $cls = \Mockery::mock(HasHttpRequests::class);
        $fn1 = function () {
        };
        $cls->pushMiddleware($fn1, 'fn1');

        $handlerStack = $cls->getHandlerStack();
        self::assertInstanceOf(HandlerStack::class, $handlerStack);
        self::assertContains('Name: \'fn1\', Function: callable', (string) $handlerStack);

        $handlerStack2 = \Mockery::mock(HandlerStack::class);
        $cls->setHandlerStack($handlerStack2);
        self::assertSame($handlerStack2, $cls->getHandlerStack());
    }

    public function testFixJsonIssue()
    {
        $cls = \Mockery::mock(DummnyClassForHasHttpRequestTest::class.'[getHandlerStack]');
        $handlerStack = \Mockery::mock(HandlerStack::class);
        $cls->allows()->getHandlerStack()->andReturn($handlerStack);

        $client = \Mockery::mock(Client::class);
        $cls->setHttpClient($client);

        $response = new Response(200, [], 'mock-result');

        // default arguments
        $client->expects()->request('POST', 'foo/bar', [
            'curl' => [
                CURLOPT_IPRESOLVE => CURL_IPRESOLVE_V4,
            ],
            'handler' => $handlerStack,
            'body' => '{}',
            'headers' => [
                'Content-Type' => 'application/json',
            ],
            'base_uri' => 'http://easyim.cn',
        ])->andReturn($response);

        self::assertSame($response, $cls->request('foo/bar', 'POST', [
            'json' => [],
        ]));

        // unescape unicode
        $client->expects()->request('POST', 'foo/bar', [
            'curl' => [
                CURLOPT_IPRESOLVE => CURL_IPRESOLVE_V4,
            ],
            'handler' => $handlerStack,
            'body' => '{"name":"中文"}',
            'headers' => [
                'Content-Type' => 'application/json',
            ],
            'base_uri' => 'http://easyim.cn',
        ])->andReturn($response);

        $cls->request('foo/bar', 'POST', [
            'json' => ['name' => '中文'],
        ]);
    }
}

class DummnyClassForHasHttpRequestTest
{
    use HasHttpRequests;

    protected $baseUri = 'http://easyim.cn';
}
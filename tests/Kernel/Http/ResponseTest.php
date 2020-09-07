<?php

namespace EasyTM\Tests\Kernel\Http;

use EasyIM\Kernel\Http\Response;
use EasyIM\Kernel\Support\Collection;
use PHPUnit\Framework\TestCase;

class ResponseTest extends TestCase
{
    public function testBasicFeatures()
    {
        $response = new Response(200, ['content-type:application/json'], '{"name": "easyim"}');

        self::assertInstanceOf(\GuzzleHttp\Psr7\Response::class, $response);

        self::assertSame('{"name": "easyim"}', (string) $response);
        self::assertSame('{"name": "easyim"}', $response->getBodyContents());
        self::assertSame('{"name":"easyim"}', $response->toJson());
        self::assertSame(['name' => 'easyim'], $response->toArray());
        self::assertSame('easyim', $response->toObject()->name);
        self::assertInstanceOf(Collection::class, $response->toCollection());
        self::assertSame(['name' => 'easyim'], $response->toCollection()->all());
    }

    public function testXMLContents()
    {
        $response = new Response(200, ['Content-Type' => ['application/xml']], '<xml><foo>foo</foo><bar>bar</bar></xml>');
        self::assertSame(['foo' => 'foo', 'bar' => 'bar'], $response->toArray());

        $response = new Response(200, ['Content-Type' => ['text/xml']], '<xml><foo>foo</foo><bar>bar</bar></xml>');
        self::assertSame(['foo' => 'foo', 'bar' => 'bar'], $response->toArray());

        $response = new Response(200, ['Content-Type' => ['text/html']], '<xml><foo>foo</foo><bar>bar</bar></xml>');
        self::assertSame(['foo' => 'foo', 'bar' => 'bar'], $response->toArray());

        $response = new Response(200, ['Content-Type' => ['application/xml']], '<xml><foo>foo</foo><bar>bar</bar></xml>');
        $result = $response->toObject();
        self::assertInstanceOf(\stdClass::class, $result);
        self::assertSame('foo', $result->foo);
        self::assertSame('bar', $result->bar);
    }

    public function testInvalidArrayableContents()
    {
        $response = new Response(200, [], 'not json string');

        self::assertInstanceOf(\GuzzleHttp\Psr7\Response::class, $response);

        self::assertSame([], $response->toArray());

        // #1291
        $json = "{\"name\":\"小明\x09了死烧部全们你把并\"}";
        \json_decode($json, true);
        self::assertSame(\JSON_ERROR_CTRL_CHAR, \json_last_error());

        $response = new Response(200, ['Content-Type' => ['application/json']], $json);
        self::assertInstanceOf(\GuzzleHttp\Psr7\Response::class, $response);
        self::assertSame(['name' => '小明了死烧部全们你把并'], $response->toArray());
    }
}

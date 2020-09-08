<?php

namespace EasyTM\Tests\Kernel\Support;

use EasyIM\Kernel\Support\Str;
use PHPUnit\Framework\TestCase;

class StrTest extends TestCase
{
    public function testCamel()
    {
        self::assertSame('fooBar', Str::camel('FooBar'));
        self::assertSame('fooBar', Str::camel('FooBar')); // cached
        self::assertSame('fooBar', Str::camel('foo_bar'));
        self::assertSame('fooBar', Str::camel('_foo_bar'));
        self::assertSame('fooBar', Str::camel('_foo_bar_'));
    }

    public function testStudly()
    {
        self::assertSame('FooBar', Str::studly('fooBar'));
        self::assertSame('FooBar', Str::studly('_foo_bar'));
        self::assertSame('FooBar', Str::studly('_foo_bar_'));
        self::assertSame('FooBar', Str::studly('_foo_bar_'));
    }

    public function testSnake()
    {
        self::assertSame('foo_bar', Str::snake('fooBar'));
        self::assertSame('foo_bar', Str::snake('fooBar')); // cached
        self::assertSame('foo_bar', Str::snake('_Foo_bar'));
        self::assertSame('foo_bar', Str::snake('FooBar'));
        self::assertSame('foo_bar', Str::snake('Foo_bar_'));
    }

    public function testTitle()
    {
        self::assertSame('Welcome Back', Str::title('welcome back'));
    }

    public function testRandom()
    {
        self::assertInternalType('string', Str::random(10));
        self::assertTrue(16 === strlen(Str::random()));
    }

    public function testQuickRandom()
    {
        self::assertInternalType('string', Str::quickRandom(10));
        self::assertTrue(16 === strlen(Str::quickRandom()));
    }

    public function testUpper()
    {
        self::assertSame('USERNAME', Str::upper('username'));
        self::assertSame('USERNAME', Str::upper('userNaMe'));
    }
}

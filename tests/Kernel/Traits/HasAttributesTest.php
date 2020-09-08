<?php

namespace EasyTM\Tests\Kernel\Traits;

use EasyIM\Kernel\Traits\HasAttributes;
use PHPUnit\Framework\TestCase;

class HasAttributesTest extends TestCase
{
    public function testBasicFeatures()
    {
        $cls = new DummyClassForHasAttributesTest();

        $cls->setAttributes([
            'foo' => 'bar',
        ]);

        // required
        self::assertSame(['foo'], $cls->getRequired());
        self::assertTrue($cls->isRequired('foo'), 'assert foo is required.');

        // all
        self::assertSame(['foo' => 'bar'], $cls->all());

        // not exists
        self::assertNull($cls->not_exists);
        self::assertSame('default', $cls->get('not_exists', 'default'));

        // getter
        self::assertSame('bar', $cls->foo);
        self::assertSame('bar', $cls->get('foo'));
        self::assertSame('bar', $cls->getAttribute('foo'));

        // isset
        self::assertTrue(isset($cls->foo), 'isset $cls->foo');

        // setter
        $cls->setAttribute('foo', 'new-foo');
        self::assertSame('new-foo', $cls->foo);

        $cls->name = 'mock-name';
        self::assertSame('mock-name', $cls->name);
        self::assertSame('mock-name', $cls->get('name'));

        // set
        $cls->set('id', 'mock-id');
        self::assertSame('mock-id', $cls->id);
    }

    public function testWith()
    {
        $cls = new DummyClassForHasAttributesTest();

        $cls->setAttributes([
            'foo' => 'bar',
        ]);

        $cls->with('bar', 'mock-value');
        self::assertSame('mock-value', $cls->bar);

        $cls->withBar('bar');
        $cls->withName('overtrue');
        self::assertSame('bar', $cls->bar);
        self::assertSame('overtrue', $cls->name);

        self::expectException(\BadMethodCallException::class);
        self::expectExceptionMessage('Method "invalidMethodName" does not exists.');

        $cls->invalidMethodName('hello', 'world!');
    }

    public function testMerge()
    {
        $cls = new DummyClassForHasAttributesTest();

        $cls->setAttributes([
            'foo' => 'bar',
            'name' => 'easywechat',
        ]);

        $cls->merge([
            'age' => 27,
        ]);

        self::assertTrue($cls->has('age'));
        self::assertSame(27, $cls->get('age'));
    }

    public function testOnly()
    {
        $cls = new DummyClassForHasAttributesTest();

        $cls->setAttributes([
            'foo' => 'bar',
            'name' => 'easywechat',
            'age' => 27,
        ]);

        self::assertSame([
            'foo' => 'bar',
        ], $cls->only('foo'));

        self::assertSame([
            'foo' => 'bar',
            'age' => 27,
        ], $cls->only(['foo', 'age']));
    }
}
class DummyClassForHasAttributesTest
{
    use HasAttributes;

    protected $required = ['foo'];
}
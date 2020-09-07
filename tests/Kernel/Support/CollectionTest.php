<?php

namespace EasyTM\Tests\Kernel\Support;

use EasyIM\Kernel\Support\Collection;
use PHPUnit\Framework\TestCase;

class CollectionTest extends TestCase
{
    public function testOnly()
    {
        $data = new Collection(['first' => 'easyIM', 'last' => 'Otwell', 'email' => 'easyIM@easyIM.com']);
        self::assertSame(['first' => 'easyIM'], $data->only(['first', 'missing'])->all());
        self::assertSame(['first' => 'easyIM', 'email' => 'easyIM@easyIM.com'], $data->only(['first', 'email'])->all());
    }

    public function testExcept()
    {
        $data = new Collection(['first' => 'easyIM', 'last' => 'Otwell', 'email' => 'easyIM@easyIM.com']);
        self::assertSame(['first' => 'easyIM'], $data->except(['last', 'email', 'missing'])->all());
        self::assertSame(['first' => 'easyIM'], $data->except('last', 'email', 'missing')->all());
        self::assertSame(['first' => 'easyIM', 'email' => 'easyIM@easyIM.com'], $data->except(['last'])->all());
        self::assertSame(['first' => 'easyIM', 'email' => 'easyIM@easyIM.com'], $data->except('last')->all());
    }

    public function testMerge()
    {
        $c = new Collection(['name' => 'Hello']);
        self::assertSame(['name' => 'Hello', 'id' => 1], $c->merge(['id' => 1])->all());
    }

    public function testHas()
    {
        $c = new Collection(['name' => 'Hello']);

        self::assertTrue($c->has('name'));
        self::assertFalse($c->has('easyIM'));
    }

    public function testFirst()
    {
        $c = new Collection(['name' => 'Hello', 'age' => 25]);

        self::assertSame('Hello', $c->first());
    }

    public function testLast()
    {
        $c = new Collection(['name' => 'Hello', 'age' => 25]);

        self::assertSame(25, $c->last());
    }

    public function testAdd()
    {
        $c = new Collection(['name' => 'Hello', 'age' => 25]);

        $c->add('foo', 'bar');

        self::assertSame('bar', $c->last());
        self::assertSame('bar', $c->foo);
    }

    public function testForget()
    {
        $c = new Collection(['name' => 'Hello', 'age' => 25]);

        $c->forget('age');

        self::assertSame('Hello', $c->last());
        self::assertNull($c->age);
    }

    public function testToArray()
    {
        $c = new Collection(['name' => 'Hello', 'age' => 25]);

        self::assertSame(['name' => 'Hello', 'age' => 25], $c->toArray());
    }

    public function testToJson()
    {
        $c = new Collection(['name' => 'Hello', 'age' => 25]);

        self::assertSame(json_encode(['name' => 'Hello', 'age' => 25]), $c->toJson());
        self::assertSame(json_encode(['name' => 'Hello', 'age' => 25]), (string) $c);
        self::assertSame(json_encode(['name' => 'Hello', 'age' => 25]), json_encode($c));
    }

    public function testSerialize()
    {
        $c = new Collection(['name' => 'Hello', 'age' => 25]);

        $sc = serialize($c);
        $c = unserialize($sc);

        self::assertSame(['name' => 'Hello', 'age' => 25], $c->all());
    }

    public function testGetIterator()
    {
        $c = new Collection(['name' => 'Hello', 'age' => 25]);

        self::assertInstanceOf(\ArrayIterator::class, $c->getIterator());

        self::assertSame(['name' => 'Hello', 'age' => 25], $c->getIterator()->getArrayCopy());
    }

    public function testCount()
    {
        $c = new Collection(['name' => 'Hello', 'age' => 25]);

        self::assertCount(2, $c);
    }

    public function testBasicFeatures()
    {
        $c = new Collection(['name' => 'Hello', 'age' => 25]);

        self::assertSame('Hello', $c->name);
        self::assertSame('Hello', $c['name']);
        self::assertSame('Hello', $c->get('name'));

        self::assertTrue(isset($c['name']), 'isset $c[\'name\']');
        self::assertTrue(isset($c->name), 'isset $c->name');
        self::assertFalse(isset($c['not-exists']), 'isset $c[\'not-exists\']');
        self::assertFalse(isset($c->not_exists), 'isset $c->not_exists');

        $c->name = 'new value';
        self::assertSame('new value', $c->name);

        $c->set('foo', 'bar');
        self::assertSame('bar', $c->foo);

        unset($c['foo']);
        $c->set('title', 'mock-title');
        unset($c->title);
        self::assertFalse(isset($c->title), 'isset $c->title');

        $c['name'] = 'Hello';
        self::assertSame(['name' => 'Hello', 'age' => 25], $c->__set_state());
    }
}

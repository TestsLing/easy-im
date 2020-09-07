<?php

namespace EasyTM\Tests\Kernel\Support;

use EasyIM\Kernel\Support\Arr;
use EasyIM\Kernel\Support\Collection;
use PHPUnit\Framework\TestCase;
use stdClass;

class ArrTest extends TestCase
{
    public function testAdd()
    {
        $array = Arr::add(['name' => 'EasyIM'], 'price', 100);
        self::assertSame(['name' => 'EasyIM', 'price' => 100], $array);
    }

    public function testCrossJoin()
    {
        // Single dimension
        self::assertSame(
            [[1, 'a'], [1, 'b'], [1, 'c']],
            Arr::crossJoin([1], ['a', 'b', 'c'])
        );
        // Square matrix
        self::assertSame(
            [[1, 'a'], [1, 'b'], [2, 'a'], [2, 'b']],
            Arr::crossJoin([1, 2], ['a', 'b'])
        );
        // Rectangular matrix
        self::assertSame(
            [[1, 'a'], [1, 'b'], [1, 'c'], [2, 'a'], [2, 'b'], [2, 'c']],
            Arr::crossJoin([1, 2], ['a', 'b', 'c'])
        );
        // 3D matrix
        self::assertSame(
            [
                [1, 'a', 'I'], [1, 'a', 'II'], [1, 'a', 'III'],
                [1, 'b', 'I'], [1, 'b', 'II'], [1, 'b', 'III'],
                [2, 'a', 'I'], [2, 'a', 'II'], [2, 'a', 'III'],
                [2, 'b', 'I'], [2, 'b', 'II'], [2, 'b', 'III'],
            ],
            Arr::crossJoin([1, 2], ['a', 'b'], ['I', 'II', 'III'])
        );
        // With 1 empty dimension
        self::assertSame([], Arr::crossJoin([], ['a', 'b'], ['I', 'II', 'III']));
        self::assertSame([], Arr::crossJoin([1, 2], [], ['I', 'II', 'III']));
        self::assertSame([], Arr::crossJoin([1, 2], ['a', 'b'], []));
        // With empty arrays
        self::assertSame([], Arr::crossJoin([], [], []));
        self::assertSame([], Arr::crossJoin([], []));
        self::assertSame([], Arr::crossJoin([]));
        // Not really a proper usage, still, test for preserving BC
        self::assertSame([[]], Arr::crossJoin());
    }

    public function testDivide()
    {
        [$keys, $values] = Arr::divide(['name' => 'EasyIM']);
        self::assertSame(['name'], $keys);
        self::assertSame(['EasyIM'], $values);
    }

    public function testDot()
    {
        $array = Arr::dot(['foo' => ['bar' => 'baz']]);
        self::assertSame(['foo.bar' => 'baz'], $array);
        $array = Arr::dot([]);
        self::assertSame([], $array);
        $array = Arr::dot(['foo' => []]);
        self::assertSame(['foo' => []], $array);
        $array = Arr::dot(['foo' => ['bar' => []]]);
        self::assertSame(['foo.bar' => []], $array);
    }

    public function testExcept()
    {
        $array = ['name' => 'EasyIM', 'price' => 100];
        $array = Arr::except($array, ['price']);
        self::assertSame(['name' => 'EasyIM'], $array);
    }

    public function testExists()
    {
        self::assertTrue(Arr::exists([1], 0));
        self::assertTrue(Arr::exists([null], 0));
        self::assertTrue(Arr::exists(['a' => 1], 'a'));
        self::assertTrue(Arr::exists(['a' => null], 'a'));
        self::assertFalse(Arr::exists([1], 1));
        self::assertFalse(Arr::exists([null], 1));
        self::assertFalse(Arr::exists(['a' => 1], 0));
    }

    public function testFirst()
    {
        $array = [100, 200, 300];
        $value = Arr::first($array, function ($value) {
            return $value >= 150;
        });
        self::assertSame(200, $value);
        self::assertSame(100, Arr::first($array));

        self::assertSame('default', Arr::first([], null, 'default'));

        self::assertSame('default', Arr::first([], function () {
            return false;
        }, 'default'));
    }

    public function testLast()
    {
        $array = [100, 200, 300];
        $last = Arr::last($array, function ($value) {
            return $value < 250;
        });
        self::assertSame(200, $last);
        $last = Arr::last($array, function ($value, $key) {
            return $key < 2;
        });
        self::assertSame(200, $last);
        self::assertSame(300, Arr::last($array));
    }

    public function testFlatten()
    {
        // Flat arrays are unaffected
        $array = ['#foo', '#bar', '#baz'];
        self::assertSame(['#foo', '#bar', '#baz'], Arr::flatten(['#foo', '#bar', '#baz']));
        // Nested arrays are flattened with existing flat items
        $array = [['#foo', '#bar'], '#baz'];
        self::assertSame(['#foo', '#bar', '#baz'], Arr::flatten($array));
        // Flattened array includes "null" items
        $array = [['#foo', null], '#baz', null];
        self::assertSame(['#foo', null, '#baz', null], Arr::flatten($array));
        // Sets of nested arrays are flattened
        $array = [['#foo', '#bar'], ['#baz']];
        self::assertSame(['#foo', '#bar', '#baz'], Arr::flatten($array));
        // Deeply nested arrays are flattened
        $array = [['#foo', ['#bar']], ['#baz']];
        self::assertSame(['#foo', '#bar', '#baz'], Arr::flatten($array));
        // Nested arrays are flattened alongside arrays
        $array = [new Collection(['#foo', '#bar']), ['#baz']];
        self::assertSame(['#foo', '#bar', '#baz'], Arr::flatten($array));
        // Nested arrays containing plain arrays are flattened
        $array = [new Collection(['#foo', ['#bar']]), ['#baz']];
        self::assertSame(['#foo', '#bar', '#baz'], Arr::flatten($array));
        // Nested arrays containing arrays are flattened
        $array = [['#foo', new Collection(['#bar'])], ['#baz']];
        self::assertSame(['#foo', '#bar', '#baz'], Arr::flatten($array));
        // Nested arrays containing arrays containing arrays are flattened
        $array = [['#foo', new Collection(['#bar', ['#zap']])], ['#baz']];
        self::assertSame(['#foo', '#bar', '#zap', '#baz'], Arr::flatten($array));
    }

    public function testFlattenWithDepth()
    {
        // No depth flattens recursively
        $array = [['#foo', ['#bar', ['#baz']]], '#zap'];
        self::assertSame(['#foo', '#bar', '#baz', '#zap'], Arr::flatten($array));
        // Specifying a depth only flattens to that depth
        $array = [['#foo', ['#bar', ['#baz']]], '#zap'];
        self::assertSame(['#foo', ['#bar', ['#baz']], '#zap'], Arr::flatten($array, 1));
        $array = [['#foo', ['#bar', ['#baz']]], '#zap'];
        self::assertSame(['#foo', '#bar', ['#baz'], '#zap'], Arr::flatten($array, 2));
    }

    public function testGet()
    {
        $array = ['products.item' => ['price' => 100]];
        self::assertSame(['price' => 100], Arr::get($array, 'products.item'));
        $array = ['products' => ['item' => ['price' => 100]]];
        $value = Arr::get($array, 'products.item');
        self::assertSame(['price' => 100], $value);
        // Test null array values
        $array = ['foo' => null, 'bar' => ['baz' => null]];
        self::assertNull(Arr::get($array, 'foo', 'default'));
        self::assertNull(Arr::get($array, 'bar.baz', 'default'));
        // Test null key returns the whole array
        $array = ['foo', 'bar'];
        self::assertSame($array, Arr::get($array, null));
        // Test $array is empty and key is null
        self::assertSame([], Arr::get([], null));
        self::assertSame([], Arr::get([], null, 'default'));
    }

    public function testHas()
    {
        $array = ['products.item' => ['price' => 100]];
        self::assertTrue(Arr::has($array, 'products.item'));
        $array = ['products' => ['item' => ['price' => 100]]];
        self::assertTrue(Arr::has($array, 'products.item'));
        self::assertTrue(Arr::has($array, 'products.item.price'));
        self::assertFalse(Arr::has($array, 'products.foo'));
        self::assertFalse(Arr::has($array, 'products.item.foo'));
        $array = ['foo' => null, 'bar' => ['baz' => null]];
        self::assertTrue(Arr::has($array, 'foo'));
        self::assertTrue(Arr::has($array, 'bar.baz'));
        $array = ['foo', 'bar'];
        self::assertFalse(Arr::has($array, null));
        self::assertFalse(Arr::has([], null));
        $array = ['products' => ['item' => ['price' => 100]]];
        self::assertTrue(Arr::has($array, ['products.item']));
        self::assertTrue(Arr::has($array, ['products.item', 'products.item.price']));
        self::assertTrue(Arr::has($array, ['products', 'products']));
        self::assertFalse(Arr::has($array, ['foo']));
        self::assertFalse(Arr::has($array, []));
        self::assertFalse(Arr::has($array, ['products.item', 'products.price']));
        self::assertFalse(Arr::has([], [null]));
    }

    public function testIsAssoc()
    {
        self::assertTrue(Arr::isAssoc(['a' => 'a', 0 => 'b']));
        self::assertTrue(Arr::isAssoc([1 => 'a', 0 => 'b']));
        self::assertTrue(Arr::isAssoc([1 => 'a', 2 => 'b']));
        self::assertFalse(Arr::isAssoc([0 => 'a', 1 => 'b']));
        self::assertFalse(Arr::isAssoc(['a', 'b']));
    }

    public function testOnly()
    {
        $array = ['name' => 'EasyIM', 'price' => 100, 'orders' => 10];
        $array = Arr::only($array, ['name', 'price']);
        self::assertSame(['name' => 'EasyIM', 'price' => 100], $array);
    }

    public function testPrepend()
    {
        $array = Arr::prepend(['one', 'two', 'three', 'four'], 'zero');
        self::assertSame(['zero', 'one', 'two', 'three', 'four'], $array);
        $array = Arr::prepend(['one' => 1, 'two' => 2], 0, 'zero');
        self::assertSame(['zero' => 0, 'one' => 1, 'two' => 2], $array);
    }

    public function testPull()
    {
        $array = ['name' => 'EasyIM', 'price' => 100];
        $name = Arr::pull($array, 'name');
        self::assertSame('EasyIM', $name);
        self::assertSame(['price' => 100], $array);
        // Only works on first level keys
        $array = ['i@example.com' => 'Joe', 'jack@localhost' => 'Jane'];
        $name = Arr::pull($array, 'i@example.com');
        self::assertSame('Joe', $name);
        self::assertSame(['jack@localhost' => 'Jane'], $array);
        // Does not work for nested keys
        $array = ['emails' => ['i@example.com' => 'Joe', 'jack@localhost' => 'Jane']];
        $name = Arr::pull($array, 'emails.i@example.com');
        self::assertNull($name);
        self::assertSame(['emails' => ['i@example.com' => 'Joe', 'jack@localhost' => 'Jane']], $array);
    }

    public function testRandom()
    {
        $randomValue = Arr::random(['foo', 'bar', 'baz']);
        self::assertContains($randomValue, ['foo', 'bar', 'baz']);
        $randomValues = Arr::random(['foo', 'bar', 'baz'], 1);
        self::assertInternalType('array', $randomValues);
        self::assertCount(1, $randomValues);
        self::assertContains($randomValues[0], ['foo', 'bar', 'baz']);
        $randomValues = Arr::random(['foo', 'bar', 'baz'], 2);
        self::assertInternalType('array', $randomValues);
        self::assertCount(2, $randomValues);
        self::assertContains($randomValues[0], ['foo', 'bar', 'baz']);
        self::assertContains($randomValues[1], ['foo', 'bar', 'baz']);
    }

    public function testSet()
    {
        $array = ['products' => ['item' => ['price' => 100]]];
        Arr::set($array, 'products.item.price', 200);
        Arr::set($array, 'goods.item.price', 200);
        self::assertSame(['products' => ['item' => ['price' => 200]], 'goods' => ['item' => ['price' => 200]]], $array);
    }

    public function testWhere()
    {
        $array = [100, '200', 300, '400', 500];
        $array = Arr::where($array, function ($value, $key) {
            return is_string($value);
        });
        self::assertSame([1 => '200', 3 => '400'], $array);
    }

    public function testWhereKey()
    {
        $array = ['10' => 1, 'foo' => 3, 20 => 2];
        $array = Arr::where($array, function ($value, $key) {
            return is_numeric($key);
        });
        self::assertSame(['10' => 1, 20 => 2], $array);
    }

    public function testForget()
    {
        $array = ['products' => ['item' => ['price' => 100]]];
        Arr::forget($array, null);
        self::assertSame(['products' => ['item' => ['price' => 100]]], $array);
        $array = ['products' => ['item' => ['price' => 100]]];
        Arr::forget($array, []);
        self::assertSame(['products' => ['item' => ['price' => 100]]], $array);
        $array = ['products' => ['item' => ['price' => 100]]];
        Arr::forget($array, 'products.item');
        self::assertSame(['products' => []], $array);
        $array = ['products' => ['item' => ['price' => 100]]];
        Arr::forget($array, 'products.item.price');
        self::assertSame(['products' => ['item' => []]], $array);
        $array = ['products' => ['item' => ['price' => 100]]];
        Arr::forget($array, 'products.final.price');
        self::assertSame(['products' => ['item' => ['price' => 100]]], $array);
        $array = ['shop' => ['cart' => [150 => 0]]];
        Arr::forget($array, 'shop.final.cart');
        self::assertSame(['shop' => ['cart' => [150 => 0]]], $array);
        $array = ['products' => ['item' => ['price' => ['original' => 50, 'taxes' => 60]]]];
        Arr::forget($array, 'products.item.price.taxes');
        self::assertSame(['products' => ['item' => ['price' => ['original' => 50]]]], $array);
        $array = ['products' => ['item' => ['price' => ['original' => 50, 'taxes' => 60]]]];
        Arr::forget($array, 'products.item.final.taxes');
        self::assertSame(['products' => ['item' => ['price' => ['original' => 50, 'taxes' => 60]]]], $array);
        $array = ['products' => ['item' => ['price' => 50], null => 'something']];
        Arr::forget($array, ['products.amount.all', 'products.item.price']);
        self::assertSame(['products' => ['item' => [], null => 'something']], $array);
        // Only works on first level keys
        $array = ['i@example.com' => 'Joe', 'i@easywechat.com' => 'Jane'];
        Arr::forget($array, 'i@example.com');
        self::assertSame(['i@easywechat.com' => 'Jane'], $array);
        // Does not work for nested keys
        $array = ['emails' => ['i@example.com' => ['name' => 'Joe'], 'jack@localhost' => ['name' => 'Jane']]];
        Arr::forget($array, ['emails.i@example.com', 'emails.jack@localhost']);
        self::assertSame(['emails' => ['i@example.com' => ['name' => 'Joe']]], $array);
    }

    public function testWrap()
    {
        $string = 'a';
        $array = ['a'];
        $object = new stdClass();
        $object->value = 'a';
        self::assertSame(['a'], Arr::wrap($string));
        self::assertSame($array, Arr::wrap($array));
        self::assertSame([$object], Arr::wrap($object));
    }
}

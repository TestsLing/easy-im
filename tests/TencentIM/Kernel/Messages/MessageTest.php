<?php

namespace EasyTM\Tests\TencentIM\Kernel\Messages;

use EasyIM\Kernel\Exceptions\InvalidArgumentException;
use EasyIM\TencentIM\Kernel\Messages\Message;
use PHPUnit\Framework\TestCase;

class MessageTest extends TestCase
{
    public function testBasicFeatures()
    {
        $message = new DummyMessageForMessageTest([
            'media_id' => '12345',
        ]);
        $this->assertSame('dummy', $message->getType());
        $this->assertSame('12345', $message->media_id);
        $this->assertSame('12345', $message->get('media_id'));
        $this->assertSame('12345', $message->getAttribute('media_id'));

        $this->assertEmpty($message->to);

        // type
        $message->setType('new-type');
        $this->assertSame('new-type', $message->getType());

        // setter
        $message->to = ['touser' => 'mock-openid'];
        $this->assertSame(['touser' => 'mock-openid'], $message->to);

        // attributes
        $message->new_attribute = 'mock-content';
        $this->assertSame('mock-content', $message->new_attribute);
    }


    public function testMissingRequiredKey()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('"required_id" cannot be empty.');
        $message = new DummyMessageForMessageTest([
            'media_id' => '12345',
            'foo' => 'f',
            'bar' => 'b',
        ]);
        $message->transformToArray();
    }
}

class DummyMessageForMessageTest extends Message
{
    protected $type = 'dummy';

    protected $properties = [
        'foo',
        'bar',
        'media_id',
        'title',
        'required_id',
    ];

    protected $required = [
        'media_id', 'required_id',
    ];
}

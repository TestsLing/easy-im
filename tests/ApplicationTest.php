<?php

use PHPUnit\Framework\TestCase;
use EasyIM\Application;

class ApplicationTest extends TestCase
{
    public function testIndex()
    {
        $app = new Application();

        $this->assertEquals(
            'init',
            $app->index()
        );
    }
}

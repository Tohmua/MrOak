<?php
namespace iaptus\{Module}\Middleware;

use phpunit_framework_TestCase;

class {Module}MiddlewareTest extends TestCase
{
    public function testCanCreateInstance()
    {
        $test = new {Module}MiddlewareFactory();
        $instance = $test();

        $this->assertTrue($instance instanceof {Module}Middleware);
    }
}

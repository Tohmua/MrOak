<?php
namespace {Namespace}{Module}\Middleware;

use PHPUnit_Framework_TestCase;

class {Module}FactoryTest extends PHPUnit_Framework_TestCase
{
    public function itReturnsAnInstance()
    {
        $test = new {Module}Factory();
        $instance = $test();

        $this->assertTrue($instance instanceof {Module});
    }
}

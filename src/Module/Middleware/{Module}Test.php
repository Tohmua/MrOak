<?php
namespace {Namespace}{Module}\Middleware;

use PHPUnit_Framework_TestCase;

class {Module}Test extends PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function canCreateInstance()
    {
        $instance = new {Module}();

        $this->assertTrue($instance instanceof {Module});
    }
}

<?php
namespace {Namespace}{Module}\Model;

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

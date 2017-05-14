<?php
namespace iaptus\{Module}\Model;

use phpunit_framework_TestCase;

class {Module}ModelTest extends TestCase
{
    public function testCanCreateInstance()
    {
        $test = new {Module}ModelFactory();
        $instance = $test();

        $this->assertTrue($instance instanceof {Module}Model);
    }
}

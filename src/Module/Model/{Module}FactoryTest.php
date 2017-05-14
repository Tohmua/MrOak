<?php
namespace {Namespace}{Module}\Model;

use PHPUnit_Framework_TestCase;

class {Module}FactoryTest extends PHPUnit_Framework_TestCase
{
    public function itReturnsAnInstance()
    {
        $prophet = new Prophet;
        $container = $prophet->prophesize(ContainerInterface::class);

        $test = new {Module}Factory($container->reveal());
        $instance = $test();

        $this->assertTrue($instance instanceof {Module});
    }
}

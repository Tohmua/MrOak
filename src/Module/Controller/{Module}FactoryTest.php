<?php
namespace {Namespace}{Module}\Controller;

use PHPUnit_Framework_TestCase;
use Prophecy\Prophet;
use Psr\Container\ContainerInterface;

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

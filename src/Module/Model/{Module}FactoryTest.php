<?php
namespace {Namespace}{Module}\Model;

use PHPUnit_Framework_TestCase;
use Prophecy\Prophet;
use Psr\Container\ContainerInterface;

class {Module}FactoryTest extends PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function itReturnsAnInstance()
    {
        $prophet = new Prophet;
        $container = $prophet->prophesize(ContainerInterface::class);

        $test = new {Module}Factory();
        $instance = $test($container->reveal());

        $this->assertTrue($instance instanceof {Module});
    }
}

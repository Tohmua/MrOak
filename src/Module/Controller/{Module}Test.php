<?php
namespace {Namespace}{Module}\Controller;

use PHPUnit_Framework_TestCase;
use Prophecy\Prophet;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\StreamInterface;

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

    /**
     * @test
     */
    public function indexAction()
    {
        $expected = 'Module: {Module}';

        $prophet = new Prophet;
        $request = $prophet->prophesize(ServerRequestInterface::class);
        $response = $prophet->prophesize(ResponseInterface::class);
        $stream = $prophet->prophesize(StreamInterface::class);

        $stream->write($expected)->willReturn($expected);
        $response->getBody()->willReturn($stream->reveal());

        $instance = new {Module}();
        $actual = $instance->index($request->reveal(), $response->reveal());

        $this->assertEquals($expected, $actual);
    }
}

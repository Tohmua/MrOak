<?php
namespace {Namespace}{Module}\Controller;

use PHPUnit_Framework_TestCase;

class {Module}Test extends PHPUnit_Framework_TestCase
{
    public function testCanCreateInstance()
    {
        $instance = new {Module}();

        $this->assertTrue($instance instanceof {Module});
    }

    public function testIndexAction()
    {
        $expected = 'Module: {Module}';

        $prophet = new Prophet;
        $request = $prophet->prophesize(ServerRequestInterface::class);
        $response = $prophet->prophesize(ResponseInterface::class);
        $response->write($expected)->willReturn($expected);

        $instance = new {Module}();
        $instance->index($request->reveal(), $response->reveal());

        $this->assertEquals($expected, $actual);
    }
}

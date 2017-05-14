<?php
namespace {Namespace}{Module}\Controller;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class {Module}
{
    public function __construct()
    {
        //
    }

    public function index(ServerRequestInterface $request, ResponseInterface $response)
    {
        return $response->getBody()->write('Module: {Module}');
    }
}

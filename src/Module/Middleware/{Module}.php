<?php
namespace {Namespace}{Module}\Middleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class {Module}
{
    public function __construct()
    {
        //
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, callable $next)
    {
        return $next($request, $response);
    }
}

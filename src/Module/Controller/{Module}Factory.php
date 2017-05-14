<?php
namespace {Namespace}{Module}\Controller;

use Psr\Container\ContainerInterface;

class {Module}Factory
{
    public function __invoke(ContainerInterface $container)
    {
        return new {Module}();
    }
}

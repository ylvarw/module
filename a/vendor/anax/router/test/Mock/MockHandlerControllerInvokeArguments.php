<?php

namespace Anax\Route;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;

/**
 * A mock handler as a controller class that has __invoke.
 */
class MockHandlerControllerInvokeArguments implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;

    public function __invoke(string $string, int $int)
    {
        return "handler/$string/$int";
    }
}

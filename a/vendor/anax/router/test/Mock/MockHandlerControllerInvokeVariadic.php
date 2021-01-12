<?php

namespace Anax\Route;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;

/**
 * A mock handler as a controller class that has __invoke.
 */
class MockHandlerControllerInvokeVariadic implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;

    public function __invoke(...$args)
    {
        return "handler/" . explode("/", $args);
    }
}

<?php

namespace Anax\Route;

/**
 * A mock handler as a class with __invoke.
 */
class MockHandlerClassInvokeVariadic
{
    public function __invoke(...$args)
    {
        return "handler/" . implode("/", $args);
    }
}

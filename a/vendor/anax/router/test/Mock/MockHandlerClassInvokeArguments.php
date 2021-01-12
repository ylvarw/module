<?php

namespace Anax\Route;

/**
 * A mock handler as a class with __invoke.
 */
class MockHandlerClassInvokeArguments
{
    public function __invoke(string $string, int $int)
    {
        return "handler/$string/$int";
    }
}

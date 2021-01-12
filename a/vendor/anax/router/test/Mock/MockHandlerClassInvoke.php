<?php

namespace Anax\Route;

/**
 * A mock handler as a class with __invoke.
 */
class MockHandlerClassInvoke
{
    public function __invoke()
    {
        return "handler";
    }
}

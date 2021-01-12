<?php

namespace Anax\Route;

/**
 * A mock handler as a class with __invoke and an initialize method.
 */
class MockHandlerClassInvokeInitialize
{
    public function initialize()
    {
        return "initialize";
    }

    public function __invoke()
    {
        return "handler";
    }
}

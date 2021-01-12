<?php

namespace Anax\Route;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;

/**
 * A mock handler as a controller class and a method.
 */
class MockHandlerControllerMethod implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;

    public function method()
    {
        return "handler";
    }

    public function method1(string $string, int $int)
    {
        return "handler/$string/$int";
    }

    public static function static()
    {
        return "handler";
    }

    public static function static1(string $string, int $int)
    {
        return "handler/$string/$int";
    }
}

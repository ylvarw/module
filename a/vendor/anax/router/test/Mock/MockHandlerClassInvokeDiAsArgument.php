<?php

namespace Anax\Route;

use Anax\Commons\ContainerInjectableInterface;

/**
 * A mock handler as a class with __invoke.
 */
class MockHandlerClassInvokeDiAsArgument
{
    public function __invoke(
        ContainerInjectableInterface $di,
        string $string,
        int $int
    ) {
        return [$di, "handler/$string/$int"];
    }
}

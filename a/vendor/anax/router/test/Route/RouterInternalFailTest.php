<?php

namespace Anax\Route;

use PHPUnit\Framework\TestCase;
use Anax\Route\Exception\NotFoundException;

/**
 * Check when internal routes fail.
 */
class RouterInternalFailTest extends TestCase
{
    /**
     * When internal route is not found.
     */
    public function testInternalRouteIsMissing()
    {
        $this->expectException("\Anax\Route\Exception\NotFoundException");

        $router = new Router();
        $router->handleInternal("403");
    }
}

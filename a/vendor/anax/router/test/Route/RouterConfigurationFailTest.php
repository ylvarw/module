<?php

namespace Anax\Route;

use PHPUnit\Framework\TestCase;
use Anax\Route\Exception\ConfigurationException;

/**
 * Test configuration of the router, when failing.
 */
class RouterConfigurationFailTest extends TestCase
{
    /**
     * Configuration item is not an array.
     */
    public function testConfigurationIsNotAnArray()
    {
        $this->expectException("\TypeError");

        $router = new Router();
        $router->addRoutes(1);
    }



    /**
     * Missing key "routes" throws exception.
     */
    public function testMissingRoute()
    {
        $this->expectException("\Anax\Route\Exception\ConfigurationException");

        $router = new Router();
        $router->addRoutes([]);
    }



    /**
     * The route is not an array.
     */
    public function testRouteIsNotAnArray()
    {
        $this->expectException("\Anax\Route\Exception\ConfigurationException");

        $router = new Router();
        $router->addRoutes(["routes" => 1]);
    }
}

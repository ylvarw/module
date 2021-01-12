<?php

namespace Anax\Route;

use Anax\DI\DIFactoryConfig;
use Anax\Route\Exception\ConfigurationException;
use PHPUnit\Framework\TestCase;

/**
 * Try $di handlers that fails.
 */
class RouteHandlerDiFailTest extends TestCase
{
    /**
     * A $di container.
     */
    private static $di;



    /**
     * Setup a fixture for all tests.
     */
    public static function setUpBeforeClass() : void
    {
        self::$di = new DIFactoryConfig();
        self::$di->loadServices([
           "services" => [
               "user" => [
                   "active" => false,
                   "shared" => true,
                   "callback" => function () {
                       $obj = new MockHandlerDiService();
                       return $obj;
                   }
               ],
           ],
        ]);
    }



    /**
     * No such service in $di.
     */
    public function testServiceDoesNotExists()
    {
        $this->expectException("\Anax\Route\Exception\ConfigurationException");

        $route = new Route();

        $route->set(null, null, null, ["noservice", "index"]);
        $this->assertTrue($route->match(""));
        $route->handle("", self::$di);
    }



    /**
     * The service does not have that method.
     */
    public function testServiceWithNoMethod()
    {
        $this->expectException("\Anax\Route\Exception\ConfigurationException");

        $route = new Route();

        $route->set(null, null, null, ["user", "nomethod"]);
        $this->assertTrue($route->match(""));
        $route->handle("", self::$di);
    }
}

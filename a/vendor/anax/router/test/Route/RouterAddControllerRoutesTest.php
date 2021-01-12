<?php

namespace Anax\Route;

use \PHPUnit\Framework\TestCase;

/**
 * Various ways of adding routes with a controller.
 */
class RouterAddControllerRoutesTest extends TestCase
{
    /**
     * Check routes starting with same name d/ and dev/.
     */
    public function testRouterPathEqualNames()
    {
        $router = new Router();

        $router->addRoute(null, "d", null, "Anax\Route\MockHandlerController");

        $router->addRoute(null, "dev", null, "Anax\Route\MockHandlerController");

        $res = $router->handle("d");
        $this->assertEquals("indexAction", $res);

        $res = $router->handle("d/index");
        $this->assertEquals("indexAction", $res);

        $res = $router->handle("d/list");
        $this->assertEquals("listAction", $res);

        $res = $router->handle("dev");
        $this->assertEquals("indexAction", $res);

        $res = $router->handle("dev/index");
        $this->assertEquals("indexAction", $res);

        $res = $router->handle("dev/list");
        $this->assertEquals("listAction", $res);
    }



    /**
     * Add longer mountpoints.
     */
    public function testRouterLongMountPoints()
    {
        $router = new Router();

        $router->addRoute(null, "d/d", null, "Anax\Route\MockHandlerController");

        $router->addRoute(null, "dev/dev", null, "Anax\Route\MockHandlerController");

        $res = $router->handle("d/d");
        $this->assertEquals("indexAction", $res);
        
        $res = $router->handle("d/d/index");
        $this->assertEquals("indexAction", $res);

        $res = $router->handle("d/d/list");
        $this->assertEquals("listAction", $res);

        $res = $router->handle("dev/dev");
        $this->assertEquals("indexAction", $res);

        $res = $router->handle("dev/dev/index");
        $this->assertEquals("indexAction", $res);

        $res = $router->handle("dev/dev/list");
        $this->assertEquals("listAction", $res);
    }
}

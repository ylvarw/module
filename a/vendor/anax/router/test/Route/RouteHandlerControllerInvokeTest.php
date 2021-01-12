<?php

namespace Anax\Route;

use Anax\DI\DI;
use PHPUnit\Framework\TestCase;

/**
 * Try controller handlers.
 */
class RouteHandlerControllerInvokeTest extends TestCase
{
    /**
     * A handler as a controller with __invoke.
     */
    public function testControllerInvoke()
    {
        $route = new Route();
        $di = new DI();

        $route->set(null, null, null, "\Anax\Route\MockHandlerControllerInvoke");
        $this->assertTrue($route->match(""));
        $res = $route->handle("", $di);
        $this->assertEquals("initialize/di/handler", $res);
    }



    /**
     * The method initialize() can return a response to prevent
     * the controller action from being called.
     */
    public function testControllerMethodInitializeReturnsResponse()
    {
        $route = new Route();

        $route->set(null, "user", null, "Anax\Route\MockHandlerClassInvokeInitialize");

        $path = "user/view";
        $this->assertTrue($route->match($path));
        $res = $route->handle($path);
        $this->assertEquals("initialize", $res);
    }

    // /**
    //  * A handler as a controller with __invoke and arguments.
    //  */
    // public function testControllerInvokeArguments()
    // {
    //     $route = new Route();
    //     $handler = new MockHandlerControllerInvokeArguments();
    //
    //     $route->set(null, "{dataset:alphanum}/{id:digit}", null, $handler);
    //     $this->assertTrue($route->match("arg1/2"));
    //     $res = $route->handle("");
    //     $this->assertEquals("handler/arg1/2", $res);
    // }
    //
    //
    //
    // /**
    //  * A handler as a controller with __invoke and variadic argument.
    //  */
    // public function testControllerInvokeVariadic()
    // {
    //     $route = new Route();
    //     $handler = new MockHandlerControllerInvokeVariadic();
    //
    //     $route->set(null, null, null, $handler);
    //     $this->assertTrue($route->match(""));
    //     $res = $route->handle("");
    //     $this->assertEquals("handler/", $res);
    //
    //     $route->set(null, "{dataset:alphanum}/{id:digit}", null, $handler);
    //     $this->assertTrue($route->match("arg1/2"));
    //     $res = $route->handle("");
    //     $this->assertEquals("handler/arg1/2", $res);
    // }
}

<?php

namespace Anax\Route;

use Anax\Commons\ContainerInjectableInterface;
use Anax\DI\DI;
use PHPUnit\Framework\TestCase;

/**
 * Try controller handler having a class implementing __invoke().
 */
class RouteHandlerClassInvokeTest extends TestCase
{
    /**
     * A handler as a class with __invoke.
     */
    public function testClassInvoke()
    {
        $route = new Route();

        $mount = "some/path";
        $path  = "some/path";
        $route->set(null, $mount, null, "\Anax\Route\MockHandlerClassInvoke");

        $res = $route->match($path);
        $this->assertTrue($res);

        $res = $route->handle($path);
        $this->assertEquals("handler", $res);

        // $route->set(null, null, null, "\Anax\Route\MockHandlerClassInvoke");
        // $this->assertTrue($route->match(""));
        //
        // $res = $route->handle("");
        // $this->assertEquals("handler", $res);
    }



    // /**
    //  * A handler as a class with __invoke and arguments.
    //  */
    // public function testClassInvokeArguments()
    // {
    //     $route = new Route();
    //
    //     $path = "arg1/2";
    //     $route->set(null, "{dataset:alphanum}/{id:digit}", null, "\Anax\Route\MockHandlerClassInvokeArguments");
    //     $this->assertTrue($route->match($path));
    //
    //     $res = $route->handle($path);
    //     $this->assertEquals("handler/$path", $res);
    // }



    // /**
    //  * A handler as a class with __invoke and variadic argument.
    //  */
    // public function testClassInvokeVariadic()
    // {
    //     $route = new Route();
    //     $handler = new MockHandlerClassInvokeVariadic();
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

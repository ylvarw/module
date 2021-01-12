<?php

namespace Anax\Route;

use Anax\Route\Exception\ConfigurationException;
use Anax\Route\Exception\NotFoundException;
use PHPUnit\Framework\TestCase;

/**
 * Try controller handlers that fails.
 */
class RouteHandlerControllerFailTest extends TestCase
{
    /**
     * Too few arguments.
     */
    public function testToFewArguments()
    {
        $this->expectException("\Anax\Route\Exception\NotFoundException");

        $route = new Route();
        $route->set(null, "user", null, "Anax\Route\MockHandlerController");
        $path = "user/view";
        $this->assertTrue($route->match($path, "GET"));
        $route->handle($path);
    }



    /**
     * Too many arguments.
     */
    public function testToManyArguments()
    {
        $this->expectException("\Anax\Route\Exception\NotFoundException");

        $route = new Route();
        $route->set(null, "user", null, "Anax\Route\MockHandlerController");
        $path = "user/view/1/1";
        $this->assertTrue($route->match($path, "GET"));
        $route->handle($path);
    }



    /**
     * Typed arguments as integer.
     */
    public function testTypedArgumentsInteger()
    {
        $this->expectException("\Anax\Route\Exception\NotFoundException");

        $route = new Route();

        $route->set(null, "user", null, "Anax\Route\MockHandlerController");

        $path = "user/view/a";
        $this->assertTrue($route->match($path, "GET"));
        $route->handle($path);
    }



    /**
     * Controller action is not a public method.
     */
    public function testControllerActionAsPrivateMethod()
    {
        $this->expectException("\Anax\Route\Exception\NotFoundException");

        $route = new Route();
    
        $route->set(null, "user", null, "Anax\Route\MockHandlerController");

        $path = "user/private";
        $this->assertTrue($route->match($path, "GET"));
        $route->handle($path);
    }



    /**
     * Try a user controller where the called action does not exists.
     */
    public function testUserControllerActionDoesNotExists()
    {
        $this->expectException("\Anax\Route\Exception\ConfigurationException");

        $route = new Route();
    
        $route->set(null, "user", null, "Anax\Route\MockHandlerController");
    
        $path = "user/no-exists";
        $this->assertTrue($route->match($path, "GET"));
        $route->handle($path);
    }
}

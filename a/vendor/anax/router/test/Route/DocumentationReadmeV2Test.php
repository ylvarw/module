<?php

namespace Anax\Route;

use Anax\Route\Exception\ForbiddenException;
use Anax\Route\Exception\InternalErrorException;
use Anax\Route\Exception\NotFoundException;
use PHPUnit\Framework\TestCase;

/**
 * Testcases.
 */
class DocumentationReadmeV2Test extends TestCase
{
    /**
     * ...
     */
    public function testTrue()
    {
        $this->assertTrue(true);
    }



    // /**
    //  * Create handler as anonymous function
    //  */
    // public function testCreateHandlersAsAnonymousFunction()
    // {
    //     $router = new Router();
    //
    //     // Anonymous function, a closure
    //     $router->add("about", function () {
    //         return "about";
    //     });
    //
    //     $res = $router->handle("about");
    //     $this->assertEquals("about", $res);
    // }



    // /**
    //  * Create handler as named function
    //  */
    // public function testCreateHandlersAsNamedFunction()
    // {
    //     $router = new Router();
    //
    //     //  How to check a variable to see if it can be called
    //     //  as a function.
    //
    //     //
    //     //  Simple variable containing a function
    //     //
    //
    //     function someFunction()
    //     {
    //     }
    //
    //     $functionVariable = 'someFunction';
    //
    //     var_dump(is_callable($functionVariable, false, $callable_name));  // bool(true)
    //
    //     echo $callable_name, "\n";  // someFunction
    //
    //     exit;
    //     // Named function
    //     function aboutHandler()
    //     {
    //         return "about";
    //     }
    //     $router->add("about", "aboutHandler");
    //     echo "\n";
    //     var_dump(is_callable("aboutHandler"));
    //     echo "ME\n";
    //     $res = $router->handle("about");
    //     $this->assertEquals("about", $res);
    // }
}

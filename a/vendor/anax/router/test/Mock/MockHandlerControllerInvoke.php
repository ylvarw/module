<?php

namespace Anax\Route;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;

/**
 * A mock handler as a controller class that has __invoke.
 */
class MockHandlerControllerInvoke implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;

    private $initialize = null;

    public function initialize()
    {
        $this->initialize = "initialize";
    }

    public function __invoke()
    {
        $di = is_object($this->di) ? "di" : null;
        return $this->initialize . "/$di/handler";
    }
}

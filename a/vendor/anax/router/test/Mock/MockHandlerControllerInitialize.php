<?php

namespace Anax\Route;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;

/**
 * A mock handler as a controller.
 */
class MockHandlerControllerInitialize implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;

    public function initialize()
    {
        return "initialize";
    }

    public function viewAction()
    {
        return "view";
    }
}

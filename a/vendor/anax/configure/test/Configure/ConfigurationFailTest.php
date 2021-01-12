<?php

namespace Anax\Configure;

use \PHPUnit\Framework\TestCase;

/**
 * A test class.
 */
class ConfigurationFailTest extends TestCase
{
    /**
     * Base directories for configuration.
     */
    protected $dirs = [
        __DIR__ . "/../config1",
        __DIR__ . "/../config2",
    ];



    /**
     * Throw exception when configuration files are missing.
     *
     * @expectedException Exception
     */
    public function testMissingConfigFile()
    {
        $cfg = new Configuration();
        $cfg->setBaseDirectories($this->dirs);
        $cfg->load("MISSING");
    }



    /**
     * Throw exception when path to base dir is wrong.
     *
     * @expectedException Exception
     */
    public function testSetBaseDirsWithWrongPath()
    {
        $cfg = new Configuration();
        $cfg->setBaseDirectories(["no path"]);
    }
}

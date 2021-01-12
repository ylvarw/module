<?php

namespace Anax\Database;

use PHPUnit\Framework\TestCase;

/**
* Check that general requirements are met.
*/
class DatabaseRequirementTest extends TestCase
{
    /**
     * Check if essential extensions are loaded.
     */
    public function testExtensionsAreLoaded()
    {
        $res = extension_loaded("PDO");
        $this->assertTrue($res);
    }
}

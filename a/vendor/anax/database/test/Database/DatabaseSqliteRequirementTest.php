<?php

namespace Anax\Database;

use PHPUnit\Framework\TestCase;

/**
* Check that general requirements are met.
*/
class DatabaseSqliteRequirementTest extends TestCase
{
    /**
     * Check if essential extensions are loaded.
     */
    public function testExtensionsAreLoaded()
    {
        $res = extension_loaded("pdo_sqlite");
        $this->assertTrue($res);
    }
}

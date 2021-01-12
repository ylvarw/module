<?php

namespace Anax\Database;

use PHPUnit\Framework\TestCase;

/**
* Negative test the database class, general tests without using an actual
* database.
*/
class DatabaseGeneralFailTest extends TestCase
{
    /**
     * Connect without a DSN.
     */
    public function testConnectWithoutDsn()
    {
        $this->expectException("Anax\Database\Exception\Exception");
        $db = new Database();
        $db->connect();
    }



    /**
     * Connect with malformed DSN.
     */
    public function testConnectWithMalformedDsn()
    {
        $this->expectException("Anax\Database\Exception\Exception");
        $db = new Database([
           "dsn" => "NO DNS"
        ]);
        $db->connect();
    }



    /**
     * Connect with malformed DSN and debug_connect set to true.
     */
    public function testConnectWithMalformedDsnAndDebugConnect()
    {
        $this->expectException("\PDOException");
        $db = new Database([
           "dsn" => "NO DNS",
           "debug_connect" => true,
        ]);
        $db->connect();
    }



    /**
     * Test execute before connect.
     */
    public function testExecuteBeforeConnect()
    {
        $this->expectException("Anax\Database\Exception\Exception");
        $db = new Database();
        $db->execute("SELECT 1;");
    }
}

<?php

namespace Anax\Database;

use PHPUnit\Framework\TestCase;

/**
* Test the database class, general tests without using an actual database.
*/
class DatabaseGeneralTest extends TestCase
{
    /**
     * Create the database object.
     */
    public function testCreateDatabaseObject()
    {
        $db = new Database();
        $this->assertInstanceOf(Database::class, $db);
    }



    /**
     * Create the database object and set options through constructor.
     */
    public function testCreateDatabaseObjectWithOptions()
    {
        $options = [
            "dsn" => "DSN",
            "username" => "USER",
            "password" => "PASS"
        ];
        $db = new DatabaseSubClass($options);
        $this->assertInstanceOf(Database::class, $db);

        $res = $db->getOptions();
        foreach (array_keys($options) as $key) {
            $this->assertArrayHasKey($key, $res);
            $val = $res[$key];
            $exp = $options[$key];
            $this->assertEquals($exp, $val);
        }
    }



    /**
     * Create the database object and set options through method setOptions.
     */
    public function testCreateDatabaseObjectSetOptions()
    {
        $options = [
            "dsn" => "DSN",
            "username" => "USER",
            "password" => "PASS"
        ];
        $db = new DatabaseSubClass();
        $this->assertInstanceOf(Database::class, $db);

        $res = $db->setOptions($options);
        $this->assertNull($res);

        $res = $db->getOptions();
        foreach (array_keys($options) as $key) {
            $this->assertArrayHasKey($key, $res);
            $val = $res[$key];
            $exp = $options[$key];
            $this->assertEquals($exp, $val);
        }
    }



    /**
     * Create the database object and set options individually through method
     * setOption.
     */
    public function testCreateDatabaseObjectSetOption()
    {
        $options = [
            "dsn" => "DSN",
            "username" => "USER",
            "password" => "PASS"
        ];
        $db = new DatabaseSubClass();
        $this->assertInstanceOf(Database::class, $db);

        $res = $db->setOption("dsn", $options["dsn"]);
        $this->assertInstanceOf(Database::class, $res);

        $res = $db->setOption("username", $options["username"]);
        $this->assertInstanceOf(Database::class, $res);

        $res = $db->setOption("password", $options["password"]);
        $this->assertInstanceOf(Database::class, $res);

        $res = $db->getOptions();
        foreach (array_keys($options) as $key) {
            $this->assertArrayHasKey($key, $res);
            $val = $res[$key];
            $exp = $options[$key];
            $this->assertEquals($exp, $val);
        }
    }



    /**
     * The option debug_connect should be false by default.
     */
    public function testDebugConnectShouldBeFalseByDefault()
    {
        $options = [
            "debug_connect" => false,
        ];
        $db = new DatabaseSubClass();
        $this->assertInstanceOf(Database::class, $db);

        $res = $db->getOptions();
        foreach (array_keys($options) as $key) {
            $this->assertArrayHasKey($key, $res);
            $val = $res[$key];
            $exp = $options[$key];
            $this->assertEquals($exp, $val);
        }
    }



    /**
     * The option verbose should be false by default.
     */
    public function testVerboseShouldBeFalseByDefault()
    {
        $options = [
            "verbose" => false,
        ];
        $db = new DatabaseSubClass();
        $this->assertInstanceOf(Database::class, $db);

        $res = $db->getOptions();
        foreach (array_keys($options) as $key) {
            $this->assertArrayHasKey($key, $res);
            $val = $res[$key];
            $exp = $options[$key];
            $this->assertEquals($exp, $val);
        }
    }



    /**
     * The option fetch_mode should be \PDO::FETCH_OBJ by default.
     */
    public function testFetchModeShouldBeObjectByDefault()
    {
        $options = [
            "fetch_mode" => \PDO::FETCH_OBJ,
        ];
        $db = new DatabaseSubClass();
        $this->assertInstanceOf(Database::class, $db);

        $res = $db->getOptions();
        foreach (array_keys($options) as $key) {
            $this->assertArrayHasKey($key, $res);
            $val = $res[$key];
            $exp = $options[$key];
            $this->assertEquals($exp, $val);
        }
    }



    /**
     * The option session_key should be "Anax\Database" by default.
     */
    public function testSessionKeyAsDefault()
    {
        $options = [
            "session_key" => "Anax\Database",
        ];
        $db = new DatabaseSubClass();
        $this->assertInstanceOf(Database::class, $db);

        $res = $db->getOptions();
        foreach (array_keys($options) as $key) {
            $this->assertArrayHasKey($key, $res);
            $val = $res[$key];
            $exp = $options[$key];
            $this->assertEquals($exp, $val);
        }
    }
}

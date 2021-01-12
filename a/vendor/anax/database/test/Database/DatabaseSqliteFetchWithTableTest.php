<?php

namespace Anax\Database;

use Anax\Database\SomeClass;
use PHPUnit\Framework\TestCase;

/**
* Test the database class using a sqlite database with a table and do various
* ways of fetching the resultset from a query.
*/
class DatabaseSqliteFetchWithTableTest extends TestCase
{
    /** Database $db the database object. */
    private $db;



    /**
     * Setup before each test case, a table with some rows.
     */
    protected function setUp(): void
    {
        $this->db = new Database([
            "dsn" => "sqlite::memory:",
        ]);

        // Connect
        $db = $this->db->connect();
        $this->assertInstanceOf(Database::class, $db);

        // Create a table
        $sql = <<<EOD
CREATE TABLE user (
    id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
    age INTEGER,
    name VARCHAR(10)
);
EOD;

        $res = $this->db->execute($sql);
        $this->assertInstanceOf(Database::class, $res);

        // Add rows to table and do assertions
        $sql = "INSERT INTO user (age, name) VALUES (?, ?);";

        // Row 1
        $res = $this->db->execute($sql, [3, "three"]);
        $this->assertInstanceOf(Database::class, $res);

        $last = $this->db->lastInsertId();
        $this->assertEquals(1, $last);

        $rows = $this->db->rowCount();
        $this->assertEquals(1, $rows);

        // Row 2
        $this->db->execute($sql, [7, "seven"]);
        $this->assertInstanceOf(Database::class, $res);

        $last = $this->db->lastInsertId();
        $this->assertEquals(2, $last);

        $rows = $this->db->rowCount();
        $this->assertEquals(1, $rows);

        // Row 3
        $this->db->execute($sql, [9, "nine"]);
        $this->assertInstanceOf(Database::class, $res);

        $last = $this->db->lastInsertId();
        $this->assertEquals(3, $last);

        $rows = $this->db->rowCount();
        $this->assertEquals(1, $rows);
    }



    /**
     * Execute a query and fetch a single column using default fetch.
     */
    public function testFetchOneColumn()
    {
        $sql = "SELECT age FROM user WHERE id = 1;";
        $res = $this->db->execute($sql);
        $this->assertInstanceOf(Database::class, $res);

        $res = $this->db->fetch();
        $this->assertInstanceOf(\stdClass::class, $res);
        $this->assertEquals(3, $res->age);
    }



    /**
     * Execute a query and fetch a single column using executeFetch.
     */
    public function testExecuteFetchOneColumn()
    {
        $sql = "SELECT age FROM user WHERE id = 1;";
        $res = $this->db->executeFetch($sql);
        $this->assertInstanceOf(\stdClass::class, $res);
        $this->assertEquals(3, $res->age);
    }



    /**
     * Execute a query and fetch a single row using default fetch.
     */
    public function testFetchOneRow()
    {
        $sql = "SELECT * FROM user WHERE id = 1;";
        $res = $this->db->execute($sql);
        $this->assertInstanceOf(Database::class, $res);

        $res = $this->db->fetch();
        $this->assertInstanceOf(\stdClass::class, $res);
        $this->assertEquals(1, $res->id);
        $this->assertEquals(3, $res->age);
        $this->assertEquals("three", $res->name);
    }



    /**
     * Execute a query and fetch a single row using executeFetch.
     */
    public function testExecuteFetchOneRow()
    {
        $sql = "SELECT * FROM user WHERE id = 1;";
        $res = $this->db->executeFetch($sql);
        $this->assertInstanceOf(\stdClass::class, $res);
        $this->assertEquals(1, $res->id);
        $this->assertEquals(3, $res->age);
        $this->assertEquals("three", $res->name);
    }



    /**
     * Execute a query without a match, and fetch a single row using default
     * fetch.
     */
    public function testFetchOneRowNoResult()
    {
        $sql = "SELECT * FROM user WHERE id = 99;";
        $res = $this->db->execute($sql);
        $this->assertInstanceOf(Database::class, $res);

        $res = $this->db->fetch();
        $this->assertNull($res);
    }



    /**
     * Execute executeFetch without a match.
     */
    public function testExecuteFetchOneRowNoResult()
    {
        $sql = "SELECT * FROM user WHERE id = 99;";
        $res = $this->db->executeFetch($sql);
        $this->assertNull($res);
    }



    /**
     * Execute a query and fetch all rows using default fetchAll.
     */
    public function testFetchAll()
    {
        $sql = "SELECT * FROM user;";
        $res = $this->db->execute($sql);
        $this->assertInstanceOf(Database::class, $res);

        $res = $this->db->fetchAll();
        $this->assertIsArray($res);
        $this->assertEquals(3, count($res));

        // Row 1
        $this->assertEquals(1, $res[0]->id);
        $this->assertEquals(3, $res[0]->age);
        $this->assertEquals("three", $res[0]->name);

        // Row 2
        $this->assertEquals(2, $res[1]->id);
        $this->assertEquals(7, $res[1]->age);
        $this->assertEquals("seven", $res[1]->name);

        // Row 3
        $this->assertEquals(3, $res[2]->id);
        $this->assertEquals(9, $res[2]->age);
        $this->assertEquals("nine", $res[2]->name);
    }



    /**
     * Execute a query and fetch all rows using executeFetchAll.
     */
    public function testExecuteFetchAll()
    {
        $sql = "SELECT * FROM user;";
        $res = $this->db->executeFetchAll($sql);
        $this->assertIsArray($res);
        $this->assertEquals(3, count($res));

        // Row 1
        $this->assertEquals(1, $res[0]->id);
        $this->assertEquals(3, $res[0]->age);
        $this->assertEquals("three", $res[0]->name);

        // Row 2
        $this->assertEquals(2, $res[1]->id);
        $this->assertEquals(7, $res[1]->age);
        $this->assertEquals("seven", $res[1]->name);

        // Row 3
        $this->assertEquals(3, $res[2]->id);
        $this->assertEquals(9, $res[2]->age);
        $this->assertEquals("nine", $res[2]->name);
    }



    /**
     * Execute a query without result and fetch all rows using default fetchAll.
     */
    public function testFetchAllNoResult()
    {
        $sql = "SELECT * FROM user WHERE id > 99;";
        $res = $this->db->execute($sql);
        $this->assertInstanceOf(Database::class, $res);

        $res = $this->db->fetchAll();
        $this->assertIsArray($res);
        $this->assertEquals(0, count($res));
    }



    /**
     * Execute a query without result and fetch all rows using executeFetchAll.
     */
    public function testExecuteFetchAllNoResult()
    {
        $sql = "SELECT * FROM user WHERE id > 99;";
        $res = $this->db->executeFetchAll($sql);
        $this->assertIsArray($res);
        $this->assertEquals(0, count($res));
    }



    /**
     * Execute a query and fetch a single column using fetchClass.
     */
    public function testFetchClassOneColumn()
    {
        $sql = "SELECT age FROM user WHERE id = 1;";
        $res = $this->db->execute($sql);
        $this->assertInstanceOf(Database::class, $res);

        $res = $this->db->fetchClass("\Anax\Database\SomeClass");
        $this->assertInstanceOf(SomeClass::class, $res);
        $this->assertEquals(3, $res->age);
    }



    /**
     * Execute a query and fetch a single row using fetchClass.
     */
    public function testFetchClassOneRow()
    {
        $sql = "SELECT * FROM user WHERE id = 1;";
        $res = $this->db->execute($sql);
        $this->assertInstanceOf(Database::class, $res);

        $res = $this->db->fetchClass("\Anax\Database\SomeClass");
        $this->assertInstanceOf(SomeClass::class, $res);
        $this->assertEquals(1, $res->id);
        $this->assertEquals(3, $res->age);
        $this->assertEquals("three", $res->name);
    }



    /**
     * Execute a query and fetch a single row using executeFetchClass.
     */
    public function testExecuteFetchClassOneRow()
    {
        $sql = "SELECT * FROM user WHERE id = 1;";
        $res = $this->db->executeFetchClass($sql, [], "\Anax\Database\SomeClass");
        $this->assertInstanceOf(SomeClass::class, $res);
        $this->assertEquals(1, $res->id);
        $this->assertEquals(3, $res->age);
        $this->assertEquals("three", $res->name);
    }



    /**
     * Execute a query without a match, and fetch a single row using fetchClass.
     */
    public function testFetchClassOneRowNoResult()
    {
        $sql = "SELECT * FROM user WHERE id = 99;";
        $res = $this->db->execute($sql);
        $this->assertInstanceOf(Database::class, $res);

        $res = $this->db->fetchClass("\Anax\Database\SomeClass");
        $this->assertNull($res);
    }



    /**
     * Execute a query without a match, and fetch a single row using fetchClass.
     */
    public function testExecuteFetchClassOneRowNoResult()
    {
        $sql = "SELECT * FROM user WHERE id = 99;";
        $res = $this->db->executeFetchClass($sql, [], "\Anax\Database\SomeClass");
        $this->assertNull($res);
    }



    /**
     * Execute a query and fetch all rows using fetchAllClass.
     */
    public function testFetchAllClass()
    {
        $sql = "SELECT * FROM user;";
        $res = $this->db->execute($sql);
        $this->assertInstanceOf(Database::class, $res);

        $res = $this->db->fetchAllClass("\Anax\Database\SomeClass");
        $this->assertIsArray($res);
        $this->assertEquals(3, count($res));

        // Row 1
        $this->assertInstanceOf(SomeClass::class, $res[0]);
        $this->assertEquals(1, $res[0]->id);
        $this->assertEquals(3, $res[0]->age);
        $this->assertEquals("three", $res[0]->name);

        // Row 2
        $this->assertInstanceOf(SomeClass::class, $res[1]);
        $this->assertEquals(2, $res[1]->id);
        $this->assertEquals(7, $res[1]->age);
        $this->assertEquals("seven", $res[1]->name);

        // Row 3
        $this->assertInstanceOf(SomeClass::class, $res[2]);
        $this->assertEquals(3, $res[2]->id);
        $this->assertEquals(9, $res[2]->age);
        $this->assertEquals("nine", $res[2]->name);
    }



    /**
     * Execute a query without result and fetch all rows using fetchAllClass.
     */
    public function testFetchAllClassNoResult()
    {
        $sql = "SELECT * FROM user WHERE id > 99;";
        $res = $this->db->execute($sql);
        $this->assertInstanceOf(Database::class, $res);

        $res = $this->db->fetchAllClass("\Anax\Database\SomeClass");
        $this->assertIsArray($res);
        $this->assertEquals(0, count($res));
    }



    /**
     * Execute a query and fetch a single column using fetchInto.
     */
    public function testFetchIntoOneColumn()
    {
        $sql = "SELECT age FROM user WHERE id = 1;";
        $res = $this->db->execute($sql);
        $this->assertInstanceOf(Database::class, $res);

        $obj = new SomeClass();
        $res = $this->db->fetchInto($obj);
        $this->assertInstanceOf(SomeClass::class, $res);
        $this->assertEquals($obj, $res);
        $this->assertEquals(3, $res->age);
    }



    /**
     * Execute a query and fetch a single row using fetchInto.
     */
    public function testFetchIntoOneRow()
    {
        $sql = "SELECT * FROM user WHERE id = 1;";
        $res = $this->db->execute($sql);
        $this->assertInstanceOf(Database::class, $res);

        $obj = new SomeClass();
        $res = $this->db->fetchInto($obj);
        $this->assertInstanceOf(SomeClass::class, $res);
        $this->assertEquals($obj, $res);
        $this->assertEquals(1, $res->id);
        $this->assertEquals(3, $res->age);
        $this->assertEquals("three", $res->name);
    }



    /**
     * Execute a query and fetch a single row using executeFetchInto.
     */
    public function testExecuteFetchIntoOneRow()
    {
        $sql = "SELECT * FROM user WHERE id = 1;";
        $obj = new SomeClass();
        $res = $this->db->executeFetchInto($sql, [], $obj);
        $this->assertInstanceOf(SomeClass::class, $res);
        $this->assertEquals($obj, $res);
        $this->assertEquals(1, $res->id);
        $this->assertEquals(3, $res->age);
        $this->assertEquals("three", $res->name);
    }



    /**
     * Execute a query without a match, and fetch a single row using fetchInto.
     */
    public function testFetchIntoOneRowNoResult()
    {
        $sql = "SELECT * FROM user WHERE id = 99;";
        $res = $this->db->execute($sql);
        $this->assertInstanceOf(Database::class, $res);

        $obj = new SomeClass();
        $res = $this->db->fetchInto($obj);
        $this->assertInstanceOf(SomeClass::class, $obj);
        $this->assertNull($res);
    }



    /**
     * Execute a query without a match, and fetch a single row using fetchInto.
     */
    public function testExecuteFetchIntoOneRowNoResult()
    {
        $sql = "SELECT * FROM user WHERE id = 99;";
        $obj = new SomeClass();
        $res = $this->db->executeFetchInto($sql, [], $obj);
        $this->assertInstanceOf(SomeClass::class, $obj);
        $this->assertNull($res);
    }
}

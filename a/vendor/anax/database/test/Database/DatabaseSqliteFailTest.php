<?php

namespace Anax\Database;

use PHPUnit\Framework\TestCase;

/**
* Negative test the database class using a sqlite database.
*/
class DatabaseSqliteFailTest extends TestCase
{
    /** Database $db the database object. */
    private $db;



    /**
     * Setup before each test case.
     */
    protected function setUp(): void
    {
        $this->db = new Database([
            "dsn" => "sqlite::memory:",
        ]);
    }



    /**
     * Malformed SQL expression.
     */
    public function testMalformedSqlExpression()
    {
        $this->expectException("Anax\Database\Exception\Exception");
        $this->db->connect();
        $this->db->execute("SLECT 1;");
    }



    /**
     * SQL expression with table not exists.
     */
    public function testSqlExpressionTableNotCreated()
    {
        $this->expectException("Anax\Database\Exception\Exception");
        $this->db->connect();
        $this->db->execute("SELECT * FROM NoTable;");
    }



    /**
     * SQL expression missmatch between ? and params, missing param.
     */
    public function testSqlExpressionMissingParam()
    {
        $this->db->connect();
        $this->db->execute("SELECT ? AS one;", []);
        $res = $this->db->fetch();
        $this->assertNull($res->one);
    }



    /**
     * SQL expression missmatch between ? and params, to many params.
     */
    public function testSqlExpressionToManyParams()
    {
        $this->expectException("Anax\Database\Exception\Exception");
        $this->db->connect();
        $this->db->execute("SELECT ? AS one;", [1, 1]);
    }



    /**
     * SQL expression missmatch between ? and params, params has key/value.
     */
    public function testSqlExpressionParamsHasKeyValue()
    {
        $this->db->connect();
        $this->db->execute("SELECT ? AS one;", ["key" => 1]);
        $res = $this->db->fetch();
        $this->assertEquals(1, $res->one);
    }
}

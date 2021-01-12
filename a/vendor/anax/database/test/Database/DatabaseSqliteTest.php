<?php

namespace Anax\Database;

use PHPUnit\Framework\TestCase;

/**
* Test the database class using a sqlite database.
*/
class DatabaseSqliteTest extends TestCase
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
            "debug_connect" => true,
        ]);
    }



    /**
     * Connect.
     */
    public function testConnect()
    {
        $db = $this->db->connect();
        $this->assertInstanceOf(Database::class, $this->db);
        $this->assertInstanceOf(Database::class, $db);
    }



    /**
     * Connect twice returns existing connection.
     */
    public function testConnectTwice()
    {
        $db = $this->db->connect();
        $this->assertInstanceOf(Database::class, $this->db);
        $this->assertInstanceOf(Database::class, $db);

        $db = $this->db->connect();
        $this->assertInstanceOf(Database::class, $this->db);
        $this->assertInstanceOf(Database::class, $db);
    }



    /**
     * Execute a query and fetch the resultset using fetch.
     */
    public function testExecuteWithFetch()
    {
        $this->db->connect();

        $sql = "SELECT 1 AS 'one';";
        $res = $this->db->execute($sql);
        $this->assertInstanceOf(Database::class, $res);

        $res = $this->db->fetch();
        $this->assertInstanceOf(\stdClass::class, $res);
        $this->assertEquals(1, $res->one);
    }



    /**
     * Execute with verbose setting outputs the SQL query.
     */
    public function testExecuteWithVerbose()
    {
        $this->db->setOption("verbose", true);
        $this->db->connect();

        ob_start();
        $sql = "SELECT 1 AS 'one';";
        $res = $this->db->execute($sql);
        $this->assertInstanceOf(Database::class, $res);
        $output = ob_get_contents();
        ob_end_clean();

        $this->assertStringContainsString($sql, $output);
    }




//     /**
//      * Testcase
//      */
//     public function testAllowMultipleCallToConnect()
//     {
//         $db = $this->db->connect();
//         $db = $this->db->connect();
//         $this->assertInstanceOf("\Anax\Database\Database", $db);
//     }
//
//
//
//     /**
//      * Testcase
//      */
//     public function testCreateObject()
//     {
//         $db = new Database();
//         $this->assertInstanceOf("\Anax\Database\Database", $db);
//     }
//
//
//
//     /**
//      * Testcase
//      *
//      * @expectedException \Anax\Database\Exception\Exception
//      */
//     public function testConnectGetException()
//     {
//         $db = new Database([]);
//         $db->connect();
//     }
//
//
//
//     /**
//      * Testcase
//      *
//      * @expectedException \PDOException
//      */
//     public function testConnectPDOException()
//     {
//         $db = new Database([
//             "dsn" => "nono::",
//             "debug_connect" => true
//         ]);
//         $db->connect();
//     }
//
//
//
//     /**
//      * Testcase
//      */
//     public function testCreateTable()
//     {
//         $sql = <<<EOD
// CREATE TABLE test (
//     id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
//     age INTEGER,
//     text VARCHAR(20)
// );
// EOD;
//         $this->db->execute($sql);
//     }
//
//
//
//     /**
//      * Testcase
//      */
//     public function testInsertSingleRow()
//     {
//         $sql = <<<EOD
// INSERT INTO test (age, text)
// VALUES
//     (?, ?)
// ;
// EOD;
//         $this->db->execute($sql, $this->rows[0]);
//         $this->db->execute($sql, $this->rows[1]);
//         $this->db->execute($sql, $this->rows[2]);
//     }
//
//
//
//     /**
//      * Testcase
//      */
//     public function testUpdateRow()
//     {
//         /*$this->db->update(
//             'test',
//             [
//                 'age' => '?',
//                 'text' => '?',
//             ],
//             "id = ?"
//         );*/
//         //$id2 = $this->db->lastInsertId();
//         //$this->db->execute(array_merge($this->rows[1], [$id2]));
//     }
//
//
//
//     /**
//      * Testcase
//      */
//     public function testDropTable()
//     {
//         $sql = "DROP TABLE test;";
//         $this->db->execute($sql);
//     }
}

<?php

namespace Anax\Database;

use Anax\Database\Exception\Exception;

/**
 * Database wrapper, provides a database API on top of PHP PDO for
 * enhancing the API and dealing with error reporting and tracking.
 */
class Database
{
    /**
     * @var array        $options used when creating the PDO object
     * @var PDO          $pdo     the PDO object
     * @var PDOStatement $stmt    the latest PDOStatement used
     */
    protected $options;
    private $pdo = null;
    private $stmt = null;



    /**
     * Constructor creating a PDO object connecting to a choosen database.
     *
     * @param array $options containing details for connecting to the database.
     */
    public function __construct(array $options = [])
    {
        $this->setOptions($options);
    }



    /**
     * Set options and connection details.
     *
     * @param array $options containing details for connecting to the database.
     *
     * @return void
     */
    public function setOptions(array $options = []) : void
    {
        $default = [
            "dsn"             => null,
            "username"        => null,
            "password"        => null,
            "driver_options"  => null,
            "table_prefix"    => null,
            "fetch_mode"      => \PDO::FETCH_OBJ,
            "emulate_prepares" => false,
            "session_key"     => "Anax\Database",
            "verbose"         => false,
            "debug_connect"   => false,
        ];

        $this->options = array_merge($default, $options);
    }



    /**
     * Set a single option for configuration and connection details.
     *
     * @param string $option which to set.
     * @param mixed  $value  to set.
     *
     * @return self
     */
    public function setOption(string $option, $value) : object
    {
        $this->options[$option] = $value;
        return $this;
    }



    /**
     * Connect to the database, allow being called multiple times
     * but ignore when connection is already made.
     *
     * @throws \Anax\Database\Exception
     *
     * @return self
     */
    public function connect() : object
    {
        if ($this->pdo) {
            return $this;
        }

        if (!isset($this->options["dsn"])) {
            throw new Exception("You can not connect, missing dsn.");
        }

        try {
            $this->pdo = new \PDO(
                $this->options["dsn"],
                $this->options["username"],
                $this->options["password"],
                $this->options["driver_options"]
            );
            $this->pdo->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, $this->options['fetch_mode']);
            $this->pdo->setAttribute(\PDO::ATTR_EMULATE_PREPARES, $this->options['emulate_prepares']);
        } catch (\PDOException $e) {
            if ($this->options["debug_connect"]) {
                throw $e;
            }
            throw new Exception("Could not connect to database, hiding connection details.");
        }

        return $this;
    }



    /**
     * Support arrays in params, extract array items and add to $params
     * and insert ? for each entry in the array.
     *
     * @param string $query  as the query to prepare.
     * @param array  $params the parameters that may contain arrays.
     *
     * @return array with query and params.
     */
    private function expandParamArray(string $query, array $params) : array
    {
        $param = [];
        $offset = -1;

        foreach ($params as $val) {
            $offset = strpos($query, "?", $offset + 1);

            if (is_array($val)) {
                $nrOfItems = count($val);

                if ($nrOfItems) {
                    $query = substr($query, 0, $offset)
                        . str_repeat("?,", $nrOfItems  - 1)
                        . "?"
                        . substr($query, $offset + 1);
                    $param = array_merge($param, $val);
                } else {
                    $param[] = null;
                }
            } else {
                $param[] = $val;
            }
        }

        return [$query, $param];
    }



    /**
     * Execute a select-query with arguments and return the resultset.
     *
     * @param string $query  the SQL statement
     * @param array  $params the params array
     *
     * @return mixed with resultset
     */
    public function executeFetchAll(string $query, array $params = []) : array
    {
        return $this->execute($query, $params)->fetchAll();
    }



    /**
     * Execute a select-query with arguments and return the first row
     * in the resultset.
     *
     * @param string $query  the SQL statement
     * @param array  $params the params array
     *
     * @return mixed with resultset
     */
    public function executeFetch(string $query, array $params = [])
    {
        return $this->execute($query, $params)->fetch();
    }



    /**
     * Execute a select-query with arguments and insert the results into
     * a new object of the class.
     *
     * @param string $query  the SQL statement
     * @param array  $params the params array
     * @param string $class  the class to create an object of and insert into
     *
     * @return null|object with resultset, null when no resultset
     */
    public function executeFetchClass(
        string $query,
        array $params,
        string $class
    ) :? object {
        return $this->execute($query, $params)->fetchClass($class);
    }



    /**
     * Execute a select-query with arguments and insert the results into
     * an existing object.
     *
     * @param string $query  the SQL statement
     * @param array  $params the params array
     * @param object $object the existing object to insert into
     *
     * @return null|object with resultset or null when no match
     */
    public function executeFetchInto(
        string $query,
        array $params,
        object $object
    ) :? object {
        return $this->execute($query, $params)->fetchInto($object);
    }



    /**
     * Fetch all rows into the resultset.
     *
     * @return array with resultset.
     */
    public function fetchAll() : array
    {
        return $this->stmt->fetchAll();
    }



    /**
     * Fetch one row as the resultset.
     *
     * @return mixed with resultset.
     */
    public function fetch()
    {
        $res = $this->stmt->fetch();
        return $res === false ? null : $res;
    }



    /**
     * Fetch one resultset as a new object from this class.
     *
     * @param string $classname which type of object to instantiate.
     *
     * @return null|object with details, null when no resultset
     */
    public function fetchClass(string $classname) :? object
    {
        $this->stmt->setFetchMode(\PDO::FETCH_CLASS, $classname);
        return $this->fetch();
    }



    /**
     * Fetch all rows as the resultset instantiated as new objects from
     * this class.
     *
     * @param string $classname which type of object to instantiate.
     *
     * @return array with resultset containing objects of $classname.
     */
    public function fetchAllClass(string $classname) : array
    {
        $this->stmt->setFetchMode(\PDO::FETCH_CLASS, $classname);
        return $this->stmt->fetchAll();
    }



    /**
     * Fetch one resultset into an object.
     *
     * @param object $object to insert values into.
     *
     * @return null|object with resultset or null when no match
     */
    public function fetchInto(object $object) :? object
    {
        $this->stmt->setFetchMode(\PDO::FETCH_INTO, $object);
        return $this->fetch();
    }



    /**
     * Execute a SQL-query and ignore the resultset.
     *
     * @param string $query  the SQL statement
     * @param array  $params the params array
     *
     * @throws Exception when failing to prepare question or when not connected.
     *
     * @return self
     */
    public function execute(string $query, array $params = []) : object
    {
        list($query, $params) = $this->expandParamArray($query, $params);

        if (!$this->pdo) {
            $this->createException("Did you forget to connect to the database?", $query, $params);
        }

        $this->stmt = $this->pdo->prepare($query);
        if (!$this->stmt) {
            $this->pdoException($query, $params);
        }

        if ($this->options["verbose"]) {
            echo $query . "\n";
            print_r($params);
        }

        $res = $this->stmt->execute($params);
        if (!$res) {
            $this->statementException($query, $params);
        }

        return $this;
    }



    /**
     * Throw exception with detailed message.
     *
     * @param string $msg    detailed error message from PDO
     * @param string $query  query to execute
     * @param array  $params to match ? in statement
     *
     * @throws Anax\Database\Exception
     *
     * @return void
     */
    protected function createException(
        string $msg,
        string $query,
        array $params
    ) : void {
        throw new Exception(
            $msg
            . "<br><br>SQL ("
            . substr_count($query, "?")
            . " params):<br><pre>$query</pre><br>PARAMS ("
            . count($params)
            . "):<br><pre>"
            . implode("\n", $params)
            . "</pre>"
        );
    }



    /**
     * Throw exception when pdo failed using detailed message.
     *
     * @param string $query  query to execute
     * @param array  $params to match ? in statement
     *
     * @return void
     */
    protected function pdoException(string $query, array $params) : void
    {
        $this->createException($this->pdo->errorInfo()[2], $query, $params);
    }



    /**
     * Throw exception when statement failed using detailed message.
     *
     * @param string $query  query to execute
     * @param array  $params to match ? in statement
     *
     * @return void
     */
    protected function statementException(string $query, array $params) : void
    {
        $this->createException($this->stmt->errorInfo()[2], $query, $params);
    }



    /**
     * Return last insert id from autoincremented key on INSERT.
     *
     * @return integer as last insert id.
     */
    public function lastInsertId() : int
    {
        return $this->pdo->lastInsertId();
    }



    /**
    * Return rows affected of last INSERT, UPDATE, DELETE
    *
    * @return integer as rows affected on last statement
    */
    public function rowCount() : int
    {
        return $this->stmt->rowCount();
    }
}

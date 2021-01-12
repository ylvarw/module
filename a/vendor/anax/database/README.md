Anax Database
==================================

[![Latest Stable Version](https://poser.pugx.org/anax/database/v/stable)](https://packagist.org/packages/anax/database)
[![Join the chat at https://gitter.im/canax/database](https://badges.gitter.im/canax/database.svg)](https://gitter.im/canax/database?utm_source=badge&utm_medium=badge&utm_campaign=pr-badge&utm_content=badge)

[![Build Status](https://travis-ci.org/canax/database.svg?branch=master)](https://travis-ci.org/canax/database)
[![CircleCI](https://circleci.com/gh/canax/database.svg?style=svg)](https://circleci.com/gh/canax/database)

[![Build Status](https://scrutinizer-ci.com/g/canax/database/badges/build.png?b=master)](https://scrutinizer-ci.com/g/canax/database/build-status/master)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/canax/database/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/canax/database/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/canax/database/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/canax/database/?branch=master)

[![Maintainability](https://api.codeclimate.com/v1/badges/ab0c4d472565d95e64ff/maintainability)](https://codeclimate.com/github/canax/database/maintainability)
[![Codacy Badge](https://api.codacy.com/project/badge/Grade/6dff6044d25646e9bcaea3a333108ded)](https://www.codacy.com/app/mosbth/database?utm_source=github.com&amp;utm_medium=referral&amp;utm_content=canax/database&amp;utm_campaign=Badge_Grade)

Anax Database module as a database abstraction layer (DBA) for wrapping PHP PDO with an additional layer of utilities and ease of use together with ability to use configuration file and attach into an Anax installation as a servide in $di.

The module is tested using MySQL and SQLite.

There are separate modules for a Database Query Builder in [`anax\database-query-builder`](https://github.com/canax/database-query-builder) and a Database Active Record in [`anax\database-active-record`](https://github.com/canax/database-active-record).



Table of content
------------------

* [Install](#Install)
* [Development](#Development)
* [Class, interface, trait](#class-interface-trait)
* [Exceptions](#exceptions)
* [Configuration file](#configuration-file)
* [DI service](#di-service)
* [Access as framework service](#access-as-framework-service)
* [Create a connection](#create-a-connection)
* [Perform a SELECT query](#perform-a-select-query)
* [Fetch versus FetchAll](#Fetch-versus-FetchAll)
* [FetchClass](#FetchClass)
* [FetchInto](#FetchInto)
* [Perform an INSERT, UPDATE, DELETE query](#perform-an-insert-update-delete-query)
* [Last insert id](#last-insert-id)
* [Row count, affected rows](#row-count-affected-rows)
* [Throw exception on failure](#throw-exception-on-failure)
* [Dependency](#Dependency)
* [License](#License)



Install
------------------

You can install the module from [`anax/database` on Packagist](https://packagist.org/packages/anax/database) using composer.

```text
composer require anax/database
```

You can then copy the default configuration files as a start.

```text
# In the root of your Anax installation
rsync -av vendor/anax/database/config .
```



Development
------------------

To work as a developer you clone the repo and install the local environment through make. Then you can run the unit tests.

```text
make install
make test
```



Class, interface, trait
------------------

The following classes exists.

| Class, interface, trait            | Description |
|------------------------------------|-------------|
| `Anax\Database\Database`           | Wrapper class for PHP PDO with enhanced error handling and extra utilities. |
| `Anax\Database\DatabaseDebug`      | An alternative class that can be used for debugging database related issues. |



Exceptions
------------------

All exceptions are in the namespace `Anax\Database\Exception\`. The following exceptions exists and may be thrown.

| Exception               | Description |
|-------------------------|-------------|
| `Exception`             | General module specific exception, for example when connection fail. |



Configuration file
------------------

This is a sample configuration file. It is usually stored in `config/database.php` when used together with Anax.

```php
/**
 * Config file for Database.
 *
 * Example for MySQL.
 *  "dsn" => "mysql:host=localhost;dbname=test;",
 *  "username" => "test",
 *  "password" => "test",
 *  "driver_options"  => [
 *      \PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'"
 *  ],
 *
 * Example for SQLite.
 *  "dsn" => "sqlite::memory:",
 *  "dsn" => "sqlite:$path",
 *
 */
return [
    "dsn"             => null,
    "username"        => null,
    "password"        => null,
    "driver_options"  => null,
    "fetch_mode"      => \PDO::FETCH_OBJ,
    "table_prefix"    => null,
    "session_key"     => "Anax\Database",
    "emulate_prepares" => false,

    // True to be very verbose during development
    "verbose"         => null,

    // True to be verbose on connection failed
    "debug_connect"   => false,
];
```

You can use if-statements within the configuration file to serve different configurations for local development environment, staging and or production environment.



DI service
------------------

The database is created as a framework service within `$di`. The following is a sample on how the database service is created through `config/di/db.php`.

```php
/**
 * Configuration file for database service.
 */
return [
    // Services to add to the container.
    "services" => [
        "db" => [
            "shared" => true,
            "callback" => function () {
                $db = new \Anax\Database\Database();

                // Load the configuration files
                $cfg = $this->get("configuration");
                $config = $cfg->load("database");

                // Set the database configuration
                $connection = $config["config"] ?? [];
                $db->setOptions($connection);

                return $db;
            }
        ],
    ],
];
```

The setup callback works like this.

1. The database object is created.
1. The configuration file is read.
1. The configuration is applied.



Access as framework service
------------------

You can access the database module as a framework service.

```php
$sql = "SELECT * FROM movie;";

# $app style
$app->db->connect();
$res = $app->db->executeFetchAll($sql);

# $di style
$db = $di->get("db");
$db->connect();
$res = $db->executeFetchAll($sql);
```



Create a connection
------------------

You must connect to the database before using it.

You may call `$db->connect()` many times, the connection is however only made once, the first time, so it is safe to call the method several times.

```php
# $app style
$app->db->connect();

# $di style
$di->get("db")->connect();
```



Perform a SELECT query
------------------

You connect and perform the query which returns a resultset.

```php
$sql = "SELECT * FROM movie;";

# $app style
$app->db->connect();
$res = $app->db->executeFetchAll($sql);

# $di style
$db = $di->get("db");
$db->connect();
$res = $db->executeFetchAll($sql);
```

The contents of `$res` is depending on the configuration key which default is set to `"fetch_mode" => \PDO::FETCH_OBJ,`.

You can also separate `executeFetchAll()` into two separate commands `execute()` and `fetchAll()`.

```php
$sql = "SELECT * FROM movie;";

# $app style
$app->db->connect();
$res = $app->db->execute($sql)->fetchAll();

# $di style
$db = $di->get("db");
$db->connect();
$res = $db->execute($sql)->fetchAll();
```



Fetch versus FetchAll
------------------

With `fetchAll()` you fetch all matching rows in an array. When no matching rows are found you get en ampty array.

With `fetch()` you get the first item in the resultset. You may use this when your resultset only contain one row.

```php
$sql = "SELECT * FROM movie WHERE id = 1;";

# $app style
$app->db->connect();
$res = $app->db->executeFetch($sql);

# $di style
$db = $di->get("db");
$db->connect();
$res = $db->executeFetch($sql);
```

The content of `$res` is now an object of type `\StdClass` and you access the resultset columns by their name, for example `$res->id`.



FetchClass
------------------

You can fetch the resultset into an object instantiated from a specified class.

```php
$sql = "SELECT * FROM movie WHERE id = ?;";

# $app style
$app->db->connect();
$res = $app->db->executeFetchClass($sql, [1], "\Anax\SomeClass");

# $di style
$db = $di->get("db");
$db->connect();
$res = $db->executeFetchClass($sql, [1], "\Anax\SomeClass");
```

The resultset is inserted into a new object of the class `"\Anax\SomeClass"`.

There is also `executeFetchAllClass()` which fetches an array of all matching rows as new objects of the class.



FetchInto
------------------

You can fetch the resultset into an existing object as public properties.

```php
$sql = "SELECT * FROM movie WHERE id = ?;";
$obj = new SomeClass();

# $app style
$app->db->connect();
$res = $app->db->executeFetchInto($sql, [1], $obj);

# $di style
$db = $di->get("db");
$db->connect();
$res = $db->executeFetchClass($sql, [1], $obj);
```

The resultset is inserted into the object `$obj`.



Perform an INSERT, UPDATE, DELETE query
------------------

These queries, that updates the database, uses `$db->execute()` and does not return a resultset.

```php
$sql = "UPDATE movie SET title = ? WHERE id = ?;";

# $app style
$app->db->connect();
$app->db->execute($sql, ["Some title", 1]);

# $di style
$db = $di->get("db");
$db->connect();
$db->execute($sql, ["Some title", 1]);
```



Last insert id
------------------

You can check the last inserted id when doing INSERT where the primary key is auto generated.

```php
$sql = "INSERT INTO movie (title) VALUES (?);";

# $app style
$app->db->connect();
$app->db->execute($sql, ["Some title"]);
$id = $app->lastInsertId();

# $di style
$db = $di->get("db");
$db->connect();
$db->execute($sql, ["Some title"]);
$id = $db->lastInsertId();
```



Row count, affected rows
------------------

You can check how many rows that are affected by the last INSERT, UPDATE, DELETE statement.

```php
$sql = "DELETE FROM movie;";

# $app style
$app->db->connect();
$app->db->execute($sql);
$num = $app->rowCount();

# $di style
$db = $di->get("db");
$db->connect();
$db->execute($sql);
$num = $db->rowCount();
```



Throw exception on failure
------------------

Exception are in general thrown as soon as something fails.

The exception is module specific `Anax\Database\Exception\Exception` and contains details from the error message from the PDO layer, either from the statement or from the PDO-object, depending on what type of error happens.



Dependency
------------------

No particular dependencies. The module is usually used within an Anax installation but can also be used without Anax.



License
------------------

This software carries a MIT license. See [LICENSE.txt](LICENSE.txt) for details.



```
 .  
..:  Copyright (c) 2013 - 2018 Mikael Roos, mos@dbwebb.se
```

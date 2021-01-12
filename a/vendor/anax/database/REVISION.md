Revision history
=================================



v2.3.1 (2020-10-23)
---------------------------------

* Update README and some comments about how to create the sqlite dsn.



v2.3.0 (2020-05-06)
---------------------------------

* Upgrade test suite to use phpunit v8.
* Swap parameters to implode, PR #9.



v2.2.1 (2018-12-10)
---------------------------------

* README how to copy the default configuration to an Anax installation.
* Removed the not used dir data/.



v2.2.0 (2018-12-10)
---------------------------------

* Adding typehint to method parameters.
* Adding typehint for returntype.
* Adding unit tests.



v2.1.3 (2018-12-07)
---------------------------------

* Adding setting "emulate_prepares" => false, to the default config file.



v2.1.2 (2018-12-07)
---------------------------------

* Remove composer.lock.



v2.1.1 (2018-12-07)
---------------------------------

* Remove Sensiolabs validation from README.
* Set PHP-restrictions in composer to >=7.2, not ^7.2.



v2.1.0 (2018-12-07)
---------------------------------

* Remove Database::fetchObject() marked as obsolete, replaced by fetchClass().
* Remove Database::fetchOne() marked as obsolete, replaced by fetch().
* Added typehints to Database.
* Added typehints to DatabaseDebug.
* Enhance unit testing.



v2.0.1 (2018-11-02)
---------------------------------

* Make it possible to configure PDO::ATTR_EMULATE_PREPARES through the configuration file setting 'emulate_prepares'.



v2.0.0 (2018-10-02)
---------------------------------

* PHP 7.2.
* Split query builder and active record to own modules.
* Removed DatabaseConfigurable.
* Updated how the di service is created.



v1.1.10 (2018-04-25)
---------------------------------

* Added Codacy and Codeclimate badge.
* Update README with documentation.
* Adding service in config/di/db.php.
* Deprecated Active Record, the aim is to move that codebase to its own repo.
* Deprecated SQL Query builder, the aim is to move that codebase to its own repo.



v1.1.9 (2017-10-23)
---------------------------------

* Fix phpdoc in Database, DatabaseQueryBuilder.



v1.1.8 (2017-10-23)
---------------------------------

* Fix phpdoc in Database.



v1.1.7 (2017-10-12)
---------------------------------

* Add support for updateWhere(), deleteWhere() and saveWhere(), fix #7.



v1.1.6 (2017-10-09)
---------------------------------

* Add support for custom name of id field, fix #6.
* Change dependecy from anax/common to anax/configure.
* Add findWhere() and findbyId().



v1.1.5 (2017-10-09)
---------------------------------

* Add unit test to ActiveRecordModel.
* Add Database::setOption() to enable set specific option to individual question.
* Database::execute now prints details when option is verbose.
* Add ActiveRecordModel::findAllWhere().



v1.1.4 (2017-09-25)
---------------------------------

* Make all private methods protected in ActiveRecordModel to enable subclassing.



v1.1.3 (2017-09-18)
---------------------------------

* Fix DatabaseQueryBuilder::configure now returns self.



v1.1.2 (2017-09-14)
---------------------------------

* DatabaseQueryBuilder::configure now returns self.



v1.1.1 (2017-09-14)
---------------------------------

* DatabaseConfigure::configure now returns self.



v1.1.0 (2017-09-05)
---------------------------------

* Adding Active Record implementation.
* Prepare to work as databasedriven models.
* Adding querybuilder.
* Moving exception into Anax\Database\Exception.
* Creating DatabaseConfigure::configure and removing setDefaultsFromConfiguration, breaking change.



v1.0.8 (2017-05-31)
---------------------------------

* Bug: when throwing statement exception on pdo failure.



v1.0.7 (2017-05-31)
---------------------------------

* Bug: change $sql to $query in Database.



v1.0.5 (2017-05-29)
---------------------------------

* Make statementException protected to work with extends.
* Reengineer fetch methods in Database.



v1.0.4 (2017-04-07)
---------------------------------

* Rewrote Database class and moved debug utilities to DatabaseDebug.
* Cleaned up Database.
* Cleaned up DatabaseTest.



v1.0.3 (2017-03-31)
---------------------------------

* Connect returns self for chaining.



v1.0.2 (2017-03-31)
---------------------------------

* Rename DatabaseConfigurable to DatabaseConfigure.
* Fix error in composer.json.



v1.0.1 (2017-03-31)
---------------------------------

* Add configurable variant of Database as DatabaseConfigurable.



v1.0.0 (2017-03-31)
---------------------------------

* First version to include in anax for test.
* Extracted from mos/cdatabase to be an anax module.

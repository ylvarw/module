Revision history
=================================



v2.0.14 (2020-11-02)
---------------------------------

* Makefile do publish cache-related files.



v2.0.13 (2020-11-02)
---------------------------------

* Update Makefile for site.



v2.0.12 (2020-10-23)
---------------------------------

* Update port for docker website to avoid port being occupied.
* Add config/apache with config files for apache within docker.
* Add config for docker with apache.



v2.0.11 (2020-10-22)
---------------------------------

* Add configuration file for docker apache in config/docker.



v2.0.10 (2020-05-26)
---------------------------------

* Update docker-compose for site.



v2.0.9 (2020-05-05)
---------------------------------

* Add phpstan composer.json
* Add make test-anax to test all anax modules in vendor/anax.



v2.0.8 (2020-04-29)
---------------------------------

* Add phpstan to make test
* Scrutinizer run tests on php 7.4
* Travis run tests on php 7.3, 7.4
* Upgrade phpunit to v9.
* Upgrade phpcs to PSR-12.



v2.0.7 (2020-04-29)
---------------------------------

* Makefile install shellcheck only on Linux/Darwin.
* Add phpstan as development tool.
* Add phpdox as development tool.



v2.0.6 (2020-04-23)
---------------------------------

* Makefile fix that shellcheck is to be installed in .bin.
* Makefile upgrade phpmd to 2.8.1.
* Makefile clean up old commented sections.
* Makefile upgrade phpdoc to v3.0.0-rc.
* Fix phpmd validation in functions.php.



v2.0.5 (2020-04-03)
---------------------------------

* Update Makefile with installation link for shellcheck.



v2.0.4 (2020-04-03)
---------------------------------

* Update Makefile with make theme to copy files from theme/.



v2.0.3 (2019-11-21)
---------------------------------

* Fix helptext in Makefile to work in dir structure with space and åäö
* Remove cimage targets from Makefile.
* Update target theme i Makefile, to get files from build dir.



v2.0.2 (2019-11-01)
---------------------------------

* Update Makefile to latest version (phpmd installation).



v2.0.1 (2019-04-24)
---------------------------------

* Update to README.



v2.0.0 (2019-04-23)
---------------------------------

* Tag as v2.
* Added docker-compose.yml to enable docker-test.



v2.0.0-beta.13 (2018-11-20)
---------------------------------

* Add (disabled by default) support for anax/proxy in htdocs/index.php.



v2.0.0-beta.12 (2018-11-12)
---------------------------------

* Update docker-compose with cli ability.



v2.0.0-beta.11 (2018-11-05)
---------------------------------

* Add di as global identifier in test/config.php.



v2.0.0-beta.10 (2018-11-05)
---------------------------------

* Allow allow-unused-foreach-variables in phpmd.



v2.0.0-beta.9 (2018-11-05)
---------------------------------

* phpmd exclude e as function name.



v2.0.0-beta.8 (2018-11-05)
---------------------------------

* phpmd exclude e.
>>>>>>> 0093c20071bea6599f554635083270217e36337b



v2.0.0-beta.7 (2018-11-01)
---------------------------------

* phpcs exclude theme/.
* Removed empty lines in travis.



v2.0.0-beta.6 (2018-09-25)
---------------------------------

* Adding interface AppInjectableInterface for app-style injection.
* Adding trait AppInjectableTrait for app-style injection.



v2.0.0-beta.5 (2018-08-28)
---------------------------------

* Improve support for logging during production mode.



v2.0.0-beta.4 (2018-08-28)
---------------------------------

* Remove specific .htaccess variants, moved to anax-oophp-me.



v2.0.0-beta.3 (2018-08-28)
---------------------------------

* Fix error in config/commons.php, define wrap in string.



v2.0.0-beta.2 (2018-08-15)
---------------------------------

* Update description in composer.json.
* Update Makefile.



v2.0.0-beta.1 (2018-08-15)
---------------------------------

* Remove comment in Makefile for check bash.



v2.0.0-alpha.8 (2018-08-14)
---------------------------------

* Updating sample htdocs/js/main.js.
* Add htdocs/img/leaf.jpg.
* Makefile install phpmd from studentserver.



v2.0.0-alpha.7 (2018-08-13)
---------------------------------

* Add info about versioning in README.
* Add make target cimage-install.



v2.0.0-alpha.6 (2018-08-10)
---------------------------------

* Install phpunit through composer.
* Add sample htdocs/css.



v2.0.0-alpha.5 (2018-08-08)
---------------------------------

* Adding unit tests.



v2.0.0-alpha.4 (2018-08-06)
---------------------------------

* Adding Anax glue in src/Commons.
* Adding src/Commons/ContainerInjectable*.php



v2.0.0-alpha.3 (2018-08-03)
---------------------------------

* Add setting for ANAX_DEVELOPMENT and ANAX_PRODUCTION in config/error_reporting.php.



v2.0.0-alpha.2 (2018-08-02)
---------------------------------

* Principal decision, use this repo as glue to glue Anax components together.
* Add src/functions.php used by more or less all Anax modules.



v2.0.0-alpha.1 (2018-08-01)
---------------------------------

* Align versioning with Anax Lite.



v1.0.0 (2018-08-01)
---------------------------------

* Support scaffolding of Anax Lite v1.0.

<?php

namespace Anax\Configure;

/**
 * Load configuration for a specified item, look in several places for the
 * configuration files or directories. Return the configuration as the value
 * received from the configuration file.
 */
class Configuration
{
    /**
     * @var array $config to save the latest loaded config to ease
     *                    access.
     */
    protected $config = [];



    /**
     * @var array $dirs where to look for configuration items.
     */
    protected $dirs = [];



    /**
     * @var array $mapping mapping items to specific configuration file, mainly
     *                     useful for testing various configuration files.
     */
    protected $mapping = [];



    /**
     * Set a specific configuration file to load for a particluar item.
     *
     * @param string $item the item to map.
     * @param string $file file to load configuration from.
     *
     * @return self to allow chaining.
     */
    public function setMapping(string $item, string $file) : object
    {
        $this->mapping[$item] = $file;
        return $this;
    }



    /**
     * Set the directories where to look for configuration
     * items (files, directories) to load.
     *
     * @throws Exception when the path to any of the directories are incorrect.
     *
     * @param array $dirs with the path to the config directories to search in.
     *
     * @return self to allow chaining.
     */
    public function setBaseDirectories(array $dirs): object
    {
        foreach ($dirs as $dir) {
            if (!(is_readable($dir) && is_dir($dir))) {
                throw new Exception("The configuration dir '$dir' is not a valid path.");
            }
        }

        $this->dirs = $dirs;
        return $this;
    }



    /**
     * Read configuration from file or directory, if a file, look though all
     * base dirs and use the first configuration that is found. A configuration
     * item can be combined from a file and a directory, when available in the
     * same base directory.
     *
     * The resulting configuration is always an array, its structure contains
     * values from each individual configuration file, like this.
     *
     * $config = [
     *      "file" => filename for file.php,
     *      "config" => result returned from file.php,
     *      "items" => [
     *          [
     *              "file" => filename for dir/file1.php,
     *              "config" => result returned from dir/file1.php,
     *          ],
     *          [
     *              "file" => filename for dir/file2.php,
     *              "config" => result returned from dir/file2.php,
     *          ],
     *      ].
     * ]
     *
     * The configuration files in the directory are loaded per alphabetical
     * order.
     *
     * @param string $item is a name representing the module and is used to
     *                     combine the path to search for.
     *
     * @throws Exception when configuration item can not be found.
     * @throws Exception when $dirs are empty.
     *
     * @return array with returned value from the loaded configuration.
     */
    public function load(string $item) : array
    {
        $found = false;
        $config = [];
        $this->config = $config;

        $mapping = $this->mapping[$item] ?? null;
        if ($mapping) {
            $config["file"] = $mapping;
            $config["config"] = require $mapping;
            $this->config = $config;
            return $config;
        }

        // The configuration is found by absolute path
        if (is_readable($item) && is_file($item)) {
            $found = true;
            $config["file"] = $item;
            $config["config"] = require $item;
            $this->config = $config;
            return $config;
        }

        foreach ($this->dirs as $dir) {
            $path = "$dir/$item";
            $file = "$path.php";

            // The configuration is found in a file
            if (is_readable($file) && is_file($file)) {
                $found = true;
                $config["file"] = $file;
                $config["config"] = require $file;
            } elseif (is_readable($path) && is_file($path)) {
                $found = true;
                $config["file"] = $path;
                $config["config"] = require $path;
            }

            // The configuration is found in a directory
            if (is_readable($path) && is_dir($path)) {
                $found = true;
                $config["items"] = $this->loadFromDir($path);
            }

            if ($found) {
                break;
            }
        }

        if (!$found) {
            throw new Exception("Configure item '$item' can not be found.");
        }

        $this->config = $config;
        return $config;
    }



    /**
     * Read configuration a directory, loop through all files and add
     * them into the $config array as:
     * [
     *      [
     *          "file" => filename for dir/file1.php,
     *          "config" => result returned from dir/file1.php,
     *      ],
     *      [
     *          "file" => filename for dir/file2.php,
     *          "config" => result returned from dir/file2.php,
     *      ],
     * ].
     *
     * @param string $path is the path to the directory containing config files.
     *
     * @return array with configuration for each file.
     */
    public function loadFromDir(string $path): array
    {
        $config = [];
        foreach (glob("$path/*.php") as $file) {
            $config[] = [
                "file" => $file,
                "config" => require $file,
            ];
        }

        return $config;
    }



    /**
     * Helper function for reading values from the configuration and apply
     * default values where configuration item is missing. This
     * helper only works when there are single configuration files,
     * it does not work when multiple configuration files are loaded
     * from a directory.
     *
     * @param string $key     matching a key in the config array.
     * @param string $default value returned when config item is not found.
     *
     * @return mixed or null if key does not exists.
     */
    public function getConfig($key, $default = null)
    {
        return $this->config["config"][$key] ?? $default;
    }
}

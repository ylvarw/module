<?php

namespace Anax\Database;

/**
 * Mock class extending database class, to be able to access protected members.
 */
class DatabaseSubClass extends Database
{
    /**
     * Return the protected $this->options to enable to inspect its content.
     */
    public function getOptions()
    {
        return $this->options;
    }
}

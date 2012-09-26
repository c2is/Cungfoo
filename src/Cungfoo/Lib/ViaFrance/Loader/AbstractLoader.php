<?php

namespace Cungfoo\Lib\ViaFrance\Loader;

use Cungfoo\Lib\RESTConnection;

abstract class AbstractLoader
{
    protected $dbConnection;

    abstract public function load($etab, $data, $language);

    public function init($con)
    {
        $this->dbConnection = $con;
    }

    public function close()
    {
    }
}

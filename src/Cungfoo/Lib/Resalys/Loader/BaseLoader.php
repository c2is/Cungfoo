<?php

namespace Cungfoo\Lib\Resalys\Loader;

use Symfony\Component\Yaml\Yaml;

abstract class BaseLoader
{
    protected $client;
    protected $baseId;
    protected $username;
    protected $password;
    protected $languageCode;

    protected $config = array();

    abstract public function load($data, $locale, \PropelPDO $con);

    public function parseConfigFile($configFile)
    {
        if (!is_file($configFile))
        {
            throw new \Exception(sprintf('the configuration file `%s` does not exist', $configFile));
        }

        $this->config = Yaml::parse($configFile)['loader'];

        return $this;
    }
}

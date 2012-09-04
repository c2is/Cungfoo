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
    protected $data = null;

    abstract public function load($locale = 'fr', \PropelPDO $con = null);

    public function __construct($location, $baseId, $username = null, $password = null, $languageCode = 'FR')
    {
        $this->client = new \SoapClient($location);

        $this->baseId       = $baseId;
        $this->username     = $username;
        $this->password     = $password;
        $this->languageCode = $languageCode;
    }

    public function parseConfigFile($configFile)
    {
        if (!is_file($configFile))
        {
            throw new \Exception(sprintf('the configuration file `%s` does not exist', $configFile));
        }

        $this->config = Yaml::parse($configFile)['loader'];

        return $this;
    }

    public function setBaseId($baseId)
    {
        $this->baseId = $baseId;
    }

    public function setUsername($username)
    {
        $this->username = $username;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function setLanguageCode($languageCode)
    {
        $this->languageCode = $languageCode;
    }

    public function getData($request)
    {
        return $this->data = $this->client->$request(
            $this->baseId,
            $this->username,
            $this->password,
            $this->languageCode
        );
    }
}

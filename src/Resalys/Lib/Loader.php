<?php

namespace Resalys\Lib;

use Silex\Application;
use Symfony\Component\Yaml\Yaml;

class Loader
{
    protected $rootDir          = null;
    protected $requests         = array();
    protected $location         = null;
    protected $baseId           = null;
    protected $username         = null;
    protected $password         = null;
    protected $languageCodes    = array();

    protected $requestToLoader = array(
        'getAllThemes'              => '\Resalys\Loader\ThemeLoader',
        'getAllRoomTypeCategories'  => '\Resalys\Loader\RoomTypeCategoryLoader',
        'getAllRoomTypes'           => '\Resalys\Loader\RoomTypeLoader',
        'getAllEtabs'               => '\Resalys\Loader\EtabLoader',
    );

    public function __construct($rootdir)
    {
        if (!is_dir($rootdir))
        {
            throw new \Exception(sprintf('the `%s` root directory does not exist', $rootdir));
        }

        $this->rootDir = $rootdir;

        $this->parseConfiguration();
    }

    public function setLocation($location)
    {
        $this->location = $location;
    }

    public function getLocation()
    {
        return $this->location;
    }

    public function setBaseId($baseId)
    {
        $this->baseId = $baseId;
    }

    public function getBaseId()
    {
        return $this->baseId;
    }

    public function setUsername($username)
    {
        $this->username = $username;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function addLanguageCodes(array $languageCodes, $reset = false)
    {
        if ($reset)
        {
            $this->languageCodes = $languageCodes;
        }
        else
        {
            $this->languageCodes = array_merge($this->languageCodes, $languageCodes);
        }

        return $this;
    }

    public function addLanguageCode($languageCode, $reset = false)
    {
        return $this->addLanguageCodes(array($languageCode), $reset);
    }

    public function getLanguageCodes()
    {
        return $this->languageCodes;
    }

    public function addRequests(array $requests, $reset = false)
    {
        if ($reset)
        {
            $this->requests = $requests;
        }
        else
        {
            $this->requests = array_merge($this->requests, $requests);
        }

        return $this;
    }

    public function addRequest($request, $reset = false)
    {
        return $this->addRequests(array($request), $reset);
    }

    public function getRequests()
    {
        return $this->requests;
    }

    protected function executeLoader($loaderClass, $request, $languageCode, \PropelPDO $con)
    {
        $client = new $loaderClass($this->location, $this->baseId, $this->username, $this->password, strtoupper($languageCode));
        $client->parseConfigFile(sprintf('%s/app/config/Resalys/loader.yml', $this->rootDir));
        $client->getData($request);
        $client->load($languageCode, $con);
    }

    protected function parseConfiguration()
    {
        $clientConfigFile = sprintf('%s/app/config/Resalys/client.yml', $this->rootDir);
        if (!is_file($clientConfigFile))
        {
            throw new \Exception(sprintf('the configuration file `%s` does not exist', $clientConfigFile));
        }

        $configuration = Yaml::parse($clientConfigFile)['client'];

        $this->addRequests(array_keys($this->requestToLoader));

        $this->location       = $configuration['location'];
        $this->baseId         = $configuration['base_id'];

        if (empty($this->languageCodes))
        {

            $languageConfigFile = sprintf('%s/app/config/languages.yml', $this->rootDir);
            if (!is_file($languageConfigFile))
            {
                throw new \Exception(sprintf('the languages configuration file `%s` does not exist', $languageConfigFile));
            }

            $this->addLanguageCodes(array_keys(Yaml::parse($languageConfigFile)['languages']));
        }
    }

    public function run()
    {
        $con = \Propel::getConnection();
        $con->beginTransaction();

        try
        {
            foreach ($this->languageCodes as $languageCode)
            {
                foreach ($this->requests as $request)
                {
                    if (!array_key_exists($request, $this->requestToLoader))
                    {
                        throw new \Exception(sprintf('the `%s` request does not exist', $request));
                    }

                    $loaderClass = $this->requestToLoader[$request];
                    if (!class_exists($loaderClass))
                    {
                        throw new \Exception(sprintf('the `%s` loader does not exist', $loaderClass));
                    }

                    $this->executeLoader($loaderClass, $request, $languageCode, $con);
                }
            }

            $con->commit();
        }
        catch (\SoapFault $exception)
        {
            $con->rollBack();

            throw new \Exception($exception);

            return false;
        }

        return true;
    }

}

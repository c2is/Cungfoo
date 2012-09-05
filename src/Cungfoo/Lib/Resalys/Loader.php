<?php

namespace Cungfoo\Lib\Resalys;

use Silex\Application;
use Symfony\Component\Yaml\Yaml;

class Loader
{
    protected $requests         = array();
    protected $location         = null;
    protected $baseId           = null;
    protected $username         = null;
    protected $password         = null;
    protected $languageCodes    = array();
    protected $params           = array();

    protected $requestToLoader = array(
        'getAllThemes'              => '\Cungfoo\Lib\Resalys\Loader\ThemeLoader',
        'getAllRoomTypeCategories'  => '\Cungfoo\Lib\Resalys\Loader\RoomTypeCategoryLoader',
        'getAllRoomTypes'           => '\Cungfoo\Lib\Resalys\Loader\RoomTypeLoader',
        'getAllEtabs'               => '\Cungfoo\Lib\Resalys\Loader\EtabLoader',
    );

    public function __construct($params = array())
    {
        foreach (array('client_configuration', 'loader_configuration', 'languages_configuration') as $file)
        {
            if (!array_key_exists($file, $params))
            {
                throw new \Exception("the $file parameter does not exist");
            }
            else if (!file_exists($params[$file]))
            {
                throw new \Exception(sprintf("the $file file `%s` does not exist", $params[$file]));
            }
        }

        $this->params = $params;
        $this->addRequests(array_keys($this->requestToLoader));
        $this->loadClientConfig($this->params['client_configuration']);
        $this->loadLanguagesConfig($this->params['languages_configuration']);
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
        $client->parseConfigFile($this->params['loader_configuration']);
        $client->getData($request);
        $client->load($languageCode, $con);
    }

    public function loadClientConfig($clientConfigFile)
    {
        $clientConfig = Yaml::parse($clientConfigFile);
        if (!array_key_exists('client', $clientConfig))
        {
            throw new \Exception("No 'client' key in client configuration file : ".$clientConfigFile);
        }

        $this->location = $clientConfig['client']['location'];
        $this->baseId = $clientConfig['client']['base_id'];
    }

    public function loadLanguagesConfig($languagesConfigFile)
    {
        $languagesConfig = Yaml::parse($languagesConfigFile);
        if (!array_key_exists('languages', $languagesConfig))
        {
            throw new \Exception("No 'languages' key in languages configuration file : ".$languagesConfigFile);
        }

        $languagesConfig = array_keys($languagesConfig['languages']);
        if (!count($languagesConfig))
        {
            throw new \Exception("No language in languages configuration file : ".$languagesConfigFile);
        }

        $this->addLanguageCodes($languagesConfig, true);
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

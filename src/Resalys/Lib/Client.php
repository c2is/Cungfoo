<?php

namespace Resalys\Lib;

abstract class Client
{
    protected $client;
    protected $baseId;
    protected $username;
    protected $password;
    protected $languageCode;

    protected $data = null;

    abstract public function load();

    public function __construct($location, $baseId, $username = null, $password = null, $languageCode = 'FR')
    {
        $this->client = new \SoapClient($location);

        $this->baseId       = $baseId;
        $this->username     = $username;
        $this->password     = $password;
        $this->languageCode = $languageCode;
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

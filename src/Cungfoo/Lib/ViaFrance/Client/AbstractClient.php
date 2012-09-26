<?php

namespace Cungfoo\Lib\ViaFrance\Client;

use Symfony\Component\Yaml\Yaml,
    Cungfoo\Lib\RESTConnection;

abstract class AbstractClient
{
    protected $base;
    protected $resource;
    protected $params = array();

    abstract public function getName();

    public function setBase($base)
    {
        $this->base = $base;
    }

    public function getBase()
    {
        return $this->base;
    }

    public function setResource($resource)
    {
        $this->resource = $resource;
    }

    public function getResource()
    {
        return $this->resource;
    }

    public function setParam($name, $value)
    {
        $this->params[$name] = $value;
    }

    public function loadConfig($configFilename)
    {
        $config = Yaml::parse($configFilename);

        if (!isset($config['services'][$this->getName()]))
        {
            throw new \Exception(sprintf("No configuration found for '%s' client", $this->getName()));
        }

        $this->base = $config['services'][$this->getName()]['base'];
        $this->resource = $config['services'][$this->getName()]['resource'];

        if (isset($config['services'][$this->getName()]['parameters']))
        {
            $this->params = $config['services'][$this->getName()]['parameters'];
        }
    }

    public function getData(RESTConnection $connection)
    {
        $connection->setServiceUrl($this->base);

        $query = $this->resource;
        if (count($this->params))
        {
            $query .= '?'.http_build_query($this->params, '', '&');
        }

        if ($connection->request($query) === false)
        {
            throw new \Exception($connection->getLastError());
        }

        return $connection->getResponseBody();
    }
}

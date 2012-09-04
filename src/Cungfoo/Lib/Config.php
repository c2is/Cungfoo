<?php

namespace Cungfoo\Lib;

use Symfony\Component\Yaml\Yaml;

/**
 * Default cungfoo configuration class
 *
 * @authors Morgan Brunot <brunot.morgan@gmail.com>
 *          Denis Roussel <denis.roussel@gmail.com>
 */
class Config
{
    protected $data = array();

    /**
     * @param string $appRootDir
     */
    public function __construct($appRootDir)
    {
        $this
            ->addParams(array('root_dir' => rtrim($appRootDir, DIRECTORY_SEPARATOR)))
            ->generate()
        ;
    }

    /**
     * Overloading __get
     * @param string $name
     *
     * @return mixed
     */
    public function __get($name)
    {
        $utils = new Utils();

        return $this->get($utils->underscore($name));
    }

    /**
     * Invoking inaccessible methods
     * @param string $method
     * @param string $args
     *
     * @return mixed
     * @throws \Exception
     */
    public function __call($method, $args)
    {
        if (strpos($method, 'get') === 0 && strlen($method) > 3)
        {
            $utils = new Utils();

            return $this->get($utils->underscore(substr($method, 3)));
        }
        throw new \Exception('Config : unknown function '.$method);
    }

    /**
     * Reading data
     * @param string $param
     *
     * @return mixed
     * @throws \Exception
     */
    public function get($param)
    {
        if (!isset($this->data[$param]))
        {
            throw new \Exception('Config : unknown param '.$param);
        }

        return $this->data[$param];
    }

    /**
     * Adding of several parameters
     * @param array $params
     *
     * @return Config
     */
    public function addParams(array $params)
    {
        $this->data = $params + $this->data;

        return $this;
    }

    /**
     * Adding parameter
     * @param string $name
     * @param mixed  $value
     *
     * @return Config
     */
    public function addParam($name, $value)
    {
        return $this->addParams(array($name => $value));
    }

    /**
     * Generating default configuration
     * @return Config
     */
    protected function generate()
    {
        return $this
            ->addParam('config_dir', sprintf('%s/app/config', $this->data['root_dir']))
        ;
    }
}

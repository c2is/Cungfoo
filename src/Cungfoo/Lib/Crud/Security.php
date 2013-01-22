<?php

namespace Cungfoo\Lib\Crud;

use Symfony\Component\Yaml\Yaml;
use Silex\Application;

/**
 * Load crud route with a config yaml file
 *
 * @author Morgan Brunot <brunot.morgan@gmail.com>
 */
class Security
{
    protected $app;
    protected $security             = array();
    protected $availableKeys        = array('role');

    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    /**
     * @param string $file
     * @throws \Exception
     */
    public function load($file)
    {
        if (!file_exists($file))
        {
            throw new \Exception(sprintf('The file "%s" does not exist', $file));
        }

        $this->security = Yaml::parse($file);
        $this->validateKeys();
    }

    public function isGranted($route = null)
    {
        if (null === $route)
        {
            $route = $this->app['request']->get('_route');
        }

        foreach ($this->security as $routePrefix => $options)
        {
            if (false !== strpos($route, $routePrefix))
            {
                if (!$this->app['security']->isGranted($options['role']))
                {
                    return false;
                }
            }
        }

        return true;
    }

    /**
     * @throws \InvalidArgumentException
     */
    protected function validateKeys()
    {
        foreach ($this->security as $route => $options)
        {
            foreach ($options as $key => $value)
            {
                if (!in_array($key, $this->availableKeys))
                {
                    throw new \InvalidArgumentException(sprintf(
                        'Crud security does not support given key: "%s". Expected one of the (%s).',
                        $key, implode(', ', $this->availableKeys)
                    ));
                }
            }
        }
    }
}

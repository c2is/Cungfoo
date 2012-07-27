<?php

namespace Cungfoo\Lib\Crud;

use Symfony\Component\Yaml\Yaml;

/**
 * Load crud route with a config yaml file
 *
 * @author Morgan Brunot <brunot.morgan@gmail.com>
 */
class Router
{
    protected $routes               = array();

    protected $prefix               = '/';
    protected $controller           = null;

    protected $availableKeys        = array('prefix', 'controller', 'items');
    protected $availableItemsKeys   = array('prefix', 'model', 'form');

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

        $crud = Yaml::parse($file)['crud'];
        $this->validateKeys($crud, $this->availableKeys);

        $this->prefix     = $crud['prefix'];
        $this->controller = $crud['controller'];
        foreach ($crud['items'] as $name => $item)
        {
            $this->validateKeys($item, $this->availableItemsKeys);
            $item['prefix'] = sprintf('%s/%s', rtrim($this->prefix, '/'), ltrim($item['prefix'], '/'));
            $this->routes[$name] = $item;
        }
    }

    /**
     * @return array
     */
    public function getRoutes()
    {
        return $this->routes;
    }

    /**
     * @return string|null
     */
    public function getController()
    {
        return $this->controller;
    }

    /**
     * @param array $array
     * @param array $availableKeys
     * @throws \InvalidArgumentException
     */
    protected function validateKeys($array, $availableKeys)
    {
        foreach ($array as $key => $value)
        {
            if (!in_array($key, $availableKeys))
            {
                throw new \InvalidArgumentException(sprintf(
                    'Crud router does not support given key: "%s". Expected one of the (%s).',
                    $key, implode(', ', $availableKeys)
                ));
            }
        }
    }
}

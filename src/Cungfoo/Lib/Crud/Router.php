<?php

namespace Cungfoo\Lib\Crud;

use Symfony\Component\Yaml\Yaml;

class Router
{
    protected $routes = array();

    protected $prefix = '/';
    protected $controller = null;

    protected $availableKeys = array('prefix', 'controller', 'items');
    protected $availableItemsKeys = array('prefix', 'model', 'form');

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

    public function getRoutes()
    {
        return $this->routes;
    }

    public function getController()
    {
        return $this->controller;
    }

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

<?php

namespace Cungfoo\Lib;

use Symfony\Component\Yaml\Yaml;

/**
 * Default cungfoo context class
 *
 * @authors Morgan Brunot <brunot.morgan@gmail.com>
 *          Denis Roussel <denis.roussel@gmail.com>
 */
class Context
{
    protected $data = array();

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
        throw new \Exception('Context : unknown function '.$method);
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
            throw new \Exception('Context : unknown param '.$param);
        }

        return $this->data[$param];
    }

    /**
     * Adding of several parameters
     * @param array $params
     *
     * @return Context
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
     * @return Context
     */
    public function addParam($name, $value)
    {
        return $this->addParams(array($name => $value));
    }

    /**
     * Adding context informations to a query
     * @param \ModelCriteria $query
     *
     * @return \ModelCriteria
     */
    public function contextualizeQuery(\ModelCriteria $query)
    {
        $queryContextualized = clone($query);
        foreach ($this->data as $name => $value)
        {
            if ($value && method_exists($queryContextualized, $filterMethod = sprintf('filterBy%sId', ucfirst($name))))
            {
                $queryContextualized
                    ->$filterMethod($value)
                    ->_or()
                    ->$filterMethod(null)
                ;
            }
            else if ($value && method_exists($queryContextualized, $filterMethod = sprintf('filterBy%s', ucfirst($name))))
            {
                $queryContextualized
                    ->$filterMethod($value)
                ;
            }
            else if ($name == 'language' && $value && method_exists($query, $useMethod = 'useI18nQuery'))
            {
                $queryContextualized
                    ->joinWithI18n($value)
                ;
            }
        }

        return $queryContextualized;
    }

    /**
     * Returns allowed context
     * @param \ModelCriteria $query
     *
     * @return array
     */
    public function getAllowedContextByQuery(\ModelCriteria $query)
    {
        $allowedContext = array();
        foreach (array_keys($this->data) as $name)
        {
            if (method_exists($query, sprintf('filterBy%sId', ucfirst($name))))
            {
                $allowedContext[$name] = $name;
            }
            else if (method_exists($query, sprintf('filterBy%s', ucfirst($name))))
            {
                $allowedContext[$name] = $name;
            }
            else if (method_exists($query, 'useI18nQuery'))
            {
                $allowedContext['language'] = 'language';
            }
        }

        return $allowedContext;
    }
}

<?php

namespace Cungfoo\Widget;

use Symfony\Component\HttpFoundation\Request;

abstract class AbstractWidget
{
    protected $app;

    public function __construct($app)
    {
        $this->app = $app;
        $this->validateParameters();
    }

    protected function requiredParameters()
    {
        return array();
    }

    protected function validateParameters() {
        foreach ($this->requiredParameters() as $requiredParam)
        {
            if (!$this->app['request']->query->has($requiredParam))
            {
                throw new \Exception(sprintf('Missing parameter %s for widget %s', $requiredParam, $this->getName()));
            }
        }
    }

    public function getMaxAge()
    {
        return 0;
    }

    public abstract function render();

    public abstract function getName();
}
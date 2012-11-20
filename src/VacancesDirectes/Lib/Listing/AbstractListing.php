<?php

namespace VacancesDirectes\Lib\Listing;

use Silex\Application;

use Symfony\Component\HttpFoundation\Request;

abstract class AbstractListing
{
    const CATALOGUE = 0;
    const DISPO     = 1;

    protected $app;
    protected $data;
    protected $type;
    protected $request;

    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    public function setData($data)
    {
        $this->data = $data;

        return $this;
    }

    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    public function setRequest(Request $request)
    {
        $this->request = $request;

        return $this;
    }

    abstract public function process();
}

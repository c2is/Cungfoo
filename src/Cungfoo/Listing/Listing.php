<?php

namespace Cungfoo\Listing;

use Silex\Application;

use Cungfoo\Listing\Filler\AbstractFiller,
    Cungfoo\Listing\Column\AbstractColumn,
    Cungfoo\Listing\Column\TextColumn,
    Cungfoo\Lib\Utils;

class Listing
{
    protected $app;
    protected $filler;
    protected $columns = array();
    protected $options = array();

    public function __construct(Application $app)
    {
        $this->app = $app;
        $this->configure();
    }

    public function getApplication()
    {
        return $this->app;
    }

    public function setApplication(Application $app)
    {
        $this->app = $app;

        return $this;
    }

    public function getOptions()
    {
        return $this->options;
    }

    public function setOptions(array $options)
    {
        $this->options = $options;

        return $this;
    }

    public function getFiller()
    {
        return $this->filler;
    }

    public function setFiller(AbstractFiller $filler)
    {
        $this->filler = $filler;

        return $this;
    }

    public function addColumn(AbstractColumn $column)
    {
        $this->columns[$column->getName()] = $column->setRenderer($this->app['twig']);

        return $this;
    }

    public function removeColumn($name)
    {
        if (isset($this->columns[$name]))
        {
            unset($this->columns[$name]);
        }

        return $this;
    }

    public function getColumnNames()
    {
        $names = array();

        foreach ($this->columns as $column)
        {
            $names[] = $column->getName();
        }

        return $names;
    }

    public function configure()
    {
    }

    public function render()
    {
        $render = array();

        foreach ($this->filler->getData() as $lineIndex => $line)
        {
            foreach ($this->columns as $columnIndex => $column)
            {
                $render[$lineIndex][$columnIndex] = $column->render($this->filler->extractData($lineIndex, $column));
            }
        }

        return $render;
    }
}
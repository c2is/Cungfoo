<?php

namespace Cungfoo\Listing\Column;

use Cungfoo\Listing\CellData;

abstract class AbstractColumn implements ColumnInterface
{
    protected   $name,
                $renderer;

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setRenderer($renderer)
    {
        $this->renderer = $renderer;
        return $this;
    }

    public function getRenderer()
    {
        return $this->renderer;
    }

    public function render(CellData $data)
    {
        if(!isset($this->renderer))
        {
            throw new \Exception(sprintf('Renderer is not defined for column "%s"', get_class($this)));
        }

        if(!$this->verifyData($data))
        {
            throw new \Exception(sprintf('CellData is not properly customize for column "%s"', get_class($this)));
        }

        return $this->renderData($data);
    }

    public function verifyData(CellData $data)
    {
        return true;
    }
}
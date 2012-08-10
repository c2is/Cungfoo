<?php

namespace Cungfoo\Listing\Filler;

use Cungfoo\Listing\Filler\FillerInterface;

abstract class AbstractFiller implements FillerInterface
{
    protected   $data,
                $options = array();

    public function __construct(\ArrayObject $data = null)
    {
        if(!is_null($data))
        {
            $this->data = $data;
        }
    }

    public function setData(\ArrayObject $data)
    {
        $this->data = $data;
    }

    public function getData()
    {
        return $this->data;
    }

    public function setOptions(array $options)
    {
        $this->options = $options;
    }
}
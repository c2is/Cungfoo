<?php

namespace Cungfoo\Listing\Filler;

use Cungfoo\Listing\Column\AbstractColumn;

interface FillerInterface
{
    public function setData(\ArrayObject $data);

    public function getData();

    public function extractData($lineIndex, AbstractColumn $column);
}
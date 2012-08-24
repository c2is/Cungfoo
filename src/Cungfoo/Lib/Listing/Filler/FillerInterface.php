<?php

namespace Cungfoo\Lib\Listing\Filler;

use Cungfoo\Lib\Listing\Column\AbstractColumn;

interface FillerInterface
{
    public function setData(\ArrayObject $data);

    public function getData();

    public function extractData($lineIndex, AbstractColumn $column);
}
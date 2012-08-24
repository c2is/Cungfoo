<?php

namespace Cungfoo\Lib\Listing\Column;

use Cungfoo\Lib\Listing\CellData;

interface ColumnInterface
{
    public function getName();

    public function getType();

    public function setOptions(array $options);

    public function getOptions();

    public function setRenderer($renderer);

    public function getRenderer();

    public function render(CellData $data);
 
    public function verifyData(CellData $data);

    public function renderData(CellData $data);
}

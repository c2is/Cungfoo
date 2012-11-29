<?php

namespace Cungfoo\Lib\Listing\Column;

use Cungfoo\Lib\Listing\CellData;

class BooleanColumn extends AbstractColumn
{
    public function verifyData(CellData $data)
    {
        return true;
    }

    public function renderData(CellData $data)
    {
        return $data->getText() ? 'Yes' : 'No';
    }

    public function getType()
    {
        return 'boolean';
    }
}

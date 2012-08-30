<?php

namespace Cungfoo\Lib\Listing\Column;

use Cungfoo\Lib\Listing\CellData;

class DateColumn extends AbstractColumn
{
    public function verifyData(CellData $data)
    {
        return true;
    }

    public function renderData(CellData $data)
    {
        return $data->getText() ? $data->getText()->format('d/m/Y') : '';
    }

    public function getType()
    {
        return 'text';
    }
}
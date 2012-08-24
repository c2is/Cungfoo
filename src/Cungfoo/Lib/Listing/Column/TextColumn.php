<?php

namespace Cungfoo\Lib\Listing\Column;

use Cungfoo\Lib\Listing\CellData;

class TextColumn extends AbstractColumn
{
    public function verifyData(CellData $data)
    {
        return true;
    }

    public function renderData(CellData $data)
    {
        return $data->getText();
    }

    public function getType()
    {
        return 'text';
    }
}
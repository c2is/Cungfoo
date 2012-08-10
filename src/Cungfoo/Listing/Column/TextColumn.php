<?php

namespace Cungfoo\Listing\Column;

use Cungfoo\Listing\CellData;

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
<?php

namespace Cungfoo\Lib\Listing\Column;

use Cungfoo\Lib\Listing\CellData;

class ImageColumn extends AbstractColumn
{
    public function verifyData(CellData $data)
    {
        return true;
    }

    public function renderData(CellData $data)
    {
        return sprintf('<img class="crud-column-media" src="%s/%s"/>', $this->options['base_path'], $data->getText());
    }

    public function getType()
    {
        return 'image';
    }
}

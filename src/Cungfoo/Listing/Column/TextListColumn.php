<?php

namespace Cungfoo\Listing\Column;

use Cungfoo\Listing\CellData;

class TextListColumn extends AbstractColumn
{
    public function verifyData(CellData $data)
    {
        return isset($data->getOptions()['list_items']) && is_array($data->getOptions()['list_items']);
    }

    public function renderData(CellData $data)
    {
        return $this->renderer->render('Cungfoo/Listing/Column/TextListColumn.twig', array(
            'items'  => $data->getOptions()['list_items']
        ));
    }

    public function getType()
    {
        return 'text_list';
    }
}
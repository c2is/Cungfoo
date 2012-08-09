<?php

namespace Cungfoo\Listing\Filler;

use Cungfoo\Listing\Column\AbstractColumn,
    Cungfoo\Listing\CellData,
    Cungfoo\Lib\Utils;

class PropelFiller extends AbstractFiller
{
    public function extractData($lineIndex, AbstractColumn $column)
    {
        $utils  = new Utils();
        $cell   = new CellData();
        $getter = 'get'.$utils->camelize($column->getName());

        switch($column->getType())
        {
            case 'text':
                $cell->setText($this->data[$lineIndex]->$getter());
                break;

            case 'link':
                $cell
                    ->setText($this->data[$lineIndex]->$getter())
                    ->setOptions(array(
                        'title' => 'toto',
                        'link' => 'http://link'
                    ))
                ;
                break;

            default:
                throw new \Exception(sprintf('Colmun type % is not handled by %s', $column->getType(), __CLASS__));
        }

        return $cell;
    }
}
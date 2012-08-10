<?php

namespace Cungfoo\Listing\Filler;

use Cungfoo\Listing\Column\AbstractColumn,
    Cungfoo\Listing\CellData,
    Cungfoo\Lib\Utils;

abstract class AbstractDatabaseFiller extends AbstractFiller
{
    public function extractData($lineIndex, AbstractColumn $column)
    {
        $utils  = new Utils();
        $cell   = new CellData();

        $data   = $this->data[$lineIndex];
        $name   = $column->getName();
        $info   = array();

        if ($this->isMultipleFK($name, $data))
        {
            if (!isset($column->getOptions()['text_field_name']))
            {
                throw new \Exception(sprintf('Option "text_field_name" is missing on "%s" listing defintion.', $name));
            }
            $info = $this->getMulitpleFKInfo($name, $data, $column->getOptions()['text_field_name']);
        }
        elseif ($this->isSingleFK($name, $data))
        {
            if (!isset($column->getOptions()['text_field_name']))
            {
                throw new \Exception(sprintf('Option "text_field_name" is missing on "%s" listing defintion.', $name));
            }
            $info[] = $this->getSingleFKInfo($name, $data, $column->getOptions()['text_field_name']);
        }
        else
        {
            $info[] = $this->getFieldInfo($name, $data);
        }

        switch($column->getType())
        {
            case 'text':
                $cell->setText($info[0]['text']);
                break;

            case 'link':
                $cell
                    ->setText($info[0]['text'])
                    ->setOptions(array(
                        'title' => $info[0]['text'],
                        'link' => 'http://link'
                    ))
                ;
                break;

            case 'text_list':
                $cell->setOptions(array(
                    'list_items' => $info
                ));
                break;

            default:
                throw new \Exception(sprintf('Colmun type "%s" is not handled by %s', $column->getType(), __CLASS__));
        }

        return $cell;
    }

    abstract protected function getFieldInfo     ($name, $data);
    abstract protected function isSingleFK       ($name, $data);
    abstract protected function isMultipleFK     ($name, $data);
    abstract protected function getSingleFKInfo  ($name, $data, $textFieldName);
    abstract protected function getMulitpleFKInfo($name, $data, $textFieldName);
}
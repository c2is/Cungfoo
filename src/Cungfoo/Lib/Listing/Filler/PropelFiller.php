<?php

namespace Cungfoo\Lib\Listing\Filler;

use Cungfoo\Lib\Listing\Column\AbstractColumn,
    Cungfoo\Lib\Listing\CellData,
    Cungfoo\Lib\Utils;

class PropelFiller extends AbstractDatabaseFiller
{
    protected function getFieldInfo($name, $data)
    {
        $utils = new Utils();

        $getter = 'get'.$utils->camelize($name);

        return array(
            'text' => $data->$getter()
        );
    }

    protected function isSingleFK($name, $data)
    {
        $utils = new Utils();

        $method = 'get'.$utils->camelize($name).'Id';

        return method_exists($data, $method);
    }

    protected function isMultipleFK($name, $data)
    {
        $utils       = new Utils();
        $plurializer = new \DefaultEnglishPluralizer();

        $method = 'get'.$utils->camelize($plurializer->getPluralForm($name));

        return method_exists($data, $method);
    }

    protected function getSingleFKInfo($name, $data, $textFieldName = null)
    {
        $utils  = new Utils();
        $method = 'get'.$utils->camelize($name);
        $object = $data->$method();

        $getTextMethod = '__toString';
        if (!is_null($textFieldName))
        {
            $getTextMethod = 'get'.$utils->camelize($textFieldName);
        }

        $text = ($object) ? $object->$getTextMethod() : '';
        $id   = ($object) ? $object->getId() : '';

        return array(
            'text' => $text,
            'id'   => $id
        );
    }

    protected function getMulitpleFKInfo($name, $data, $textFieldName = null)
    {
        $utils       = new Utils();
        $plurializer = new \DefaultEnglishPluralizer();
        $info        = array();

        $method  = 'get'.$utils->camelize($plurializer->getPluralForm($name));
        $objects = $data->$method();

        $getTextMethod = '__toString';
        if (!is_null($textFieldName))
        {
            $getTextMethod = 'get'.$utils->camelize($textFieldName);
        }

        if (count($objects))
        {
            foreach ($objects as $object)
            {
                $info[] = array(
                    'text' => $object->$getTextMethod(),
                    'id'   => $object->getId()
                );
            }
        }

        return $info;
    }
}
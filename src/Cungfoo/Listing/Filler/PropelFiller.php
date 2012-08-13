<?php

namespace Cungfoo\Listing\Filler;

use Cungfoo\Listing\Column\AbstractColumn,
    Cungfoo\Listing\CellData,
    Cungfoo\Lib\Utils;

class PropelFiller extends AbstractDatabaseFiller
{
    protected function getFieldInfo($name, $data)
    {
        $utils = new Utils();

        $getter = 'get'.$utils->camelize($name);

        return array(
            'text' => is_object($data->$getter()) ? $data->$getter()->__toString() : $data->$getter()
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

    protected function getSingleFKInfo($name, $data, $textFieldName)
    {
        $utils  = new Utils();
        $method = 'get'.$utils->camelize($name);
        $object = $data->$method();

        return array(
            'text' => $object->$getTextMethod(),
            'id'   => $object->getId()
        );
    }

    protected function getMulitpleFKInfo($name, $data, $textFieldName)
    {
        $utils       = new Utils();
        $plurializer = new \DefaultEnglishPluralizer();
        $info        = array();

        $method  = 'get'.$utils->camelize($plurializer->getPluralForm($name));
        $objects = $data->$method();

        if (count($objects))
        {
            $getTextMethod = 'get'.$utils->camelize($textFieldName);
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
<?php

namespace Cungfoo\Parser;

/**
 * @author William Durand <william.durand1@gmail.com>
 */
class TwigObjectParser extends \PropelJSONParser
{
    /**
     * {@inheritdoc}
     */
    public function fromArray($array)
    {
        $output     = array();

        foreach ($array as $fieldname => $value)
        {
            if (is_object($value))
            {
                if ('DateTime' === get_class($value))
                {
                    $output[$fieldname] = $value->format('\l\e d/m/Y \à H\hi');
                }
            }

            else
            {
                $output[$fieldname] = $value;
            }

        }

        return $output;
    }
}

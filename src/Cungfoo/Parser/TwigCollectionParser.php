<?php

namespace Cungfoo\Parser;

/**
 * @author William Durand <william.durand1@gmail.com>
 */
class TwigCollectionParser extends \PropelJSONParser
{
    /**
     * {@inheritdoc}
     */
    public function fromArray($array)
    {
        $collection = array_values($array);
        $output     = array();

        foreach ($collection as $index => $object)
        {
            foreach ($object as $fieldname => $value)
            {
                if (is_object($value))
                {
                    if ('DateTime' === get_class($value))
                    {
                        $output[$index][$fieldname] = $value->format('\l\e d/m/Y \à H\hi');
                    }
                }

                else
                {
                    $output[$index][$fieldname] = $value;
                }

            }
        }

        return $output;
    }
}

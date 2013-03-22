<?php

namespace VacancesDirectes\Lib\Listing;

use Silex\Application;

use Symfony\Component\HttpFoundation\Request;

use Cungfoo\Model\Etablissement;

class CatalogueListing extends AbstractListing
{
    public function process()
    {
        $results = array(
            'type'    => $this->type,
            'element' => array()
        );

        $prefix  = 0;
        $element = array();

        foreach ($this->data as $data)
        {
            $prefix++;
            $index  = ($data->getMinimumPrice() *100) . str_pad($prefix, 3, '0', STR_PAD_LEFT);

            $element[$index] = array(
                'model' => $data,
                'extra' => 'extra',
            );
        }

        ksort($element);

        $results['element'] = $element;

        return $results;
    }
}

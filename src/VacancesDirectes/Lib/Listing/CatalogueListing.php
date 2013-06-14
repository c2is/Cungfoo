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
        $notPriced = array();

        foreach ($this->data as $data)
        {
            $prefix++;
            if (!$data->getMinimumPrice()) {
                $notPriced[] = array(
                    'model' => $data,
                    'extra' => 'extra',
                );
            } else {
                $index  = ($data->getMinimumPrice() *100) . str_pad($prefix, 3, '0', STR_PAD_LEFT);

                $element[$index] = array(
                    'model' => $data,
                    'extra' => 'extra',
                );
            }
        }

        ksort($element);

        foreach ($notPriced as $npElement) {
            $element[] = $npElement;
        }

        $results['element'] = $element;

        return $results;
    }
}

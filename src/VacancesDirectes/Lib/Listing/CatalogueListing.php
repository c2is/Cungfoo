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

        foreach ($this->data as $data)
        {
            $results['element'][] = array(
                'model' => $data,
                'extra' => 'extra',
            );
        }

        return $results;
    }
}

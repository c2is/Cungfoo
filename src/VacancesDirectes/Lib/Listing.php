<?php

namespace VacancesDirectes\Lib;

use Silex\Application;

use Symfony\Component\HttpFoundation\Request;

use Cungfoo\Model\Etablissement;

class Listing
{
    const CATALOGUE = 0;
    const DISPO     = 1;

    protected $app;
    protected $etablissements;
    protected $type;
    protected $request;

    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    public function setEtablissements($etablissements)
    {
        $this->etablissements = $etablissements;

        return $this;
    }

    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    public function setRequest(Request $request)
    {
        $this->request = $request;

        return $this;
    }

    public function process()
    {
        $results = array(
            'type'    => $this->type,
            'element' => array()
        );

        foreach ($this->etablissements as $etablissement)
        {
            $results['element'][] = array(
                'model' => $etablissement,
                'extra' => 'extra',
            );
        }

        return $results;
    }
}
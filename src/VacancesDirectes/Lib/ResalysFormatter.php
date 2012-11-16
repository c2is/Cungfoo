<?php

namespace VacancesDirectes\Lib;

use Silex\Application;

use Resalys\Lib\Client\DisponibiliteClient;

use Cungfoo\Model\Etablissement;

class ResalysFormatter
{
    protected $app;
    protected $date;
    protected $days;
    protected $adults;

    public function __construct(Application $app, $date, $days, $adults = 1)
    {
        $this->app = $app;
        $this->date = $date;
        $this->days = $days;
        $this->adults = $adults;
    }

    public function process()
    {
        $client = new DisponibiliteClient($this->app['config']->get('root_dir'));
        $client->addOptions(array(
            'start_date'  => $this->date,
            'nb_adults'   => $this->adults,
            'nb_days'     => $this->days,
            'languages'   => array($this->app['context']->getLanguage()),
            'max_results' => 5,
            'etab_list'   => '5,117',
        ));

        $client->parse();

        $etabs = array();
        if (property_exists($client->getData()['getProposals65']['fr'], 'proposal'))
        {
            foreach ($client->getData()['getProposals65']['fr']->{'proposal'} as $proposal)
            {
                var_dump($proposal->{'etab_id'});die;
            }
        }

        $results = array(
            'type'    => VacancesDirectes\Lib\Listing::DISPO,
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

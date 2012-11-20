<?php

namespace VacancesDirectes\Lib\Listing;

use Resalys\Lib\Client\DisponibiliteClient;

use Cungfoo\Model\Etablissement;

class DispoListing extends AbstractListing
{
    protected $client;

    public function setClient(DisponibiliteClient $client)
    {
        $this->client = $client;

        return $this;
    }

    public function process()
    {
        $this->client->parse();

        $results = array(
            'type'    => self::DISPO,
            'element' => array()
        );

        $etabs = array();
        if (property_exists($this->client->getData()['getProposals65']['fr'], 'proposal'))
        {
            foreach ($this->client->getData()['getProposals65']['fr']->{'proposal'} as $proposal)
            {
                $etab = \Cungfoo\Model\EtablissementQuery::create()
                    ->joinWithI18n($this->app['context']->get('language'))
                    ->filterByCode($proposal->{'etab_id'})
                    ->findOne()
                ;

                $key = sprintf("%s_%s_%s",
                    $proposal->{'etab_id'},
                    $proposal->{'start_date'},
                    $proposal->{'end_date'}
                );

                if (!in_array($key, $results['element']))
                {
                    $results['element'][$key]['model'] = $etab;
                }

                $startDate = \DateTime::createFromFormat('d/m/Y', $proposal->{'start_date'});
                $now       = new \DateTime();
                $interval = $now->diff($startDate);

                $results['element'][$key]['extra'][$proposal->{'proposal_key'}] = $proposal;
                $results['element'][$key]['start_date']     = $proposal->{'start_date'};
                $results['element'][$key]['end_date']       = $proposal->{'end_date'};
                $results['element'][$key]['days_countdown'] = $interval->format('%a');
            }
        }

        return $results;
    }
}

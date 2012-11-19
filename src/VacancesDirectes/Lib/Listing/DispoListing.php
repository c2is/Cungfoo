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

                if (!in_array($proposal->{'etab_id'}, $results['element']))
                {
                    $results['element'][$proposal->{'etab_id'}]['model'] = $etab;
                }

                $results['element'][$proposal->{'etab_id'}]['extra'][$proposal->{'proposal_key'}] = $proposal;
                $results['element'][$proposal->{'etab_id'}]['start_date'] = $proposal->{'start_date'};
                $results['element'][$proposal->{'etab_id'}]['end_date'] = $proposal->{'end_date'};
            }
        }

//echo "<pre>";
  //      var_dump($results);die;


        return $results;
    }
}

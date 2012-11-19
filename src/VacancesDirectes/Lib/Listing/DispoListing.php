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

                $results['element'][$proposal->{'etab_id'}]['extra'][$proposal->{'adult_price'}] = $proposal;
            }
        }

        return $results;
    }
}

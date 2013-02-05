<?php

namespace VacancesDirectes\Lib\Listing;

use Resalys\Lib\Client\DisponibiliteClient;

use Cungfoo\Model\Etablissement;

class DispoListing extends AbstractListing
{
    protected $client;

    protected $distinct = false;

    protected $limit = null;

    protected $etabs = array();

    protected $contrePropos = false;

    public function setClient(DisponibiliteClient $client)
    {
        $this->client = $client;

        return $this;
    }

    public function distinct()
    {
        $this->distinct = true;

        return $this;
    }

    public function limit($number)
    {
        $this->limit = $number;

        return $this;
    }

    public function process()
    {
        $this->client->parse();

        $results = array(
            'type'    => self::DISPO,
            'element' => array(),
            'contrePropos' => false
        );

        $etabs = array();
        if (property_exists($this->client->getData()['getProposals65'][$this->app['context']->get('language')], 'proposal'))
        {
            $loopIndex = 0;
            if (is_array($this->client->getData()['getProposals65'][$this->app['context']->get('language')]->{'proposal'}))
            {
                foreach ($this->client->getData()['getProposals65'][$this->app['context']->get('language')]->{'proposal'} as $proposal)
                {
                    if ($this->limit !== null && $loopIndex >= $this->limit)
                    {
                        break;
                    }

                    $results = $this->addElement($proposal, $results, $loopIndex);
                }
            }
            else
            {
                $results = $this->addElement($this->client->getData()['getProposals65'][$this->app['context']->get('language')]->{'proposal'}, $results, $loopIndex);
            }
        }

        return $results;
    }

    protected function addElement($proposal, $results, &$loopIndex)
    {
        $locale = $this->app['context']->get('language');

        $etab = \Cungfoo\Model\EtablissementQuery::create()
            ->filterByCode($proposal->{'etab_id'})
            ->filterByActive(true)
            ->useI18nQuery($locale)
                ->filterByActiveLocale(true)
            ->endUse()
            ->findOne()
        ;

        if (!$etab)
        {
            return $results;
        }

        if ($this->distinct && in_array($etab->getCode(), $this->etabs))
        {
            return $results;
        }

        $this->etabs[] = $etab->getCode();

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

        if($proposal->{'proposal_type'} == 3 && !$this->contrePropos){
            $this->contrePropos = true;
        }

        $results['element'][$key]['extra'][$proposal->{'proposal_key'}] = $proposal;
        $results['element'][$key]['start_date']     = $proposal->{'start_date'};
        $results['element'][$key]['end_date']       = $proposal->{'end_date'};
        $results['element'][$key]['days_countdown'] = $interval->format('%a');
        $results['contrePropos'] = $this->contrePropos;

        $loopIndex++;

        return $results;
    }
}

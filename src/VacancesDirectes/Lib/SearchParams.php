<?php

namespace VacancesDirectes\Lib;

use Silex\Application;

use Cungfoo\Model\VilleQuery,
    Cungfoo\Model\EtablissementQuery;

class SearchParams
{
    protected $app;

    protected $largeScope = '';
    protected $smallScope = '';
    protected $startDate  = '';
    protected $endDate    = '';
    protected $nbAdults   = '';
    protected $nbChildren = '';
    protected $maxResults = '';
    protected $nbDays     = '';


    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    public function setLargeScope($largeScope)
    {
        $this->largeScope = $largeScope;

        return $this;
    }

    public function setSmallScope($smallScope)
    {
        $this->smallScope = $smallScope;

        return $this;
    }

    public function setDates($startDate, $endDate = '')
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;

        return $this;
    }

    public function setNbAdults($nbAdults)
    {
        $this->nbAdults = $nbAdults;

        return $this;
    }

    public function setNbChildren($nbChildren)
    {
        $this->nbChildren = $nbChildren;

        return $this;
    }

    public function setMaxResults($maxResults)
    {
        $this->maxResults = $maxResults;

        return $this;
    }

    public function setNbDays($nbDays)
    {
        $this->nbDays = $nbDays;

        return $this;
    }

    public function generate()
    {
        $ville = VilleQuery::create()
            ->filterByCode($this->smallScope)
            ->findOne()
        ;

        $camping = null;

        if (!$ville)
        {
            $camping = EtablissementQuery::create()
                ->filterByCode($this->smallScope)
                ->findOne()
            ;
        }

        $searchThemes = $this->largeScope;
        if ($ville)
        {
            $searchThemes .= ','.$ville;
        }

        $startDate = \DateTime::createFromFormat('Y-m-d', $this->startDate);
        $endDate   = \DateTime::createFromFormat('Y-m-d', $this->endDate);
        $nbDays    = ($this->nbDays != '') ? $this->nbDays : $endDate->diff($startDate)->format('%a');

        return array(
            'start_date'    => $startDate->format('d/m/Y'),
            'nb_days'       => $nbDays,
            'search_themes' => $searchThemes,
            'nb_adults'     => $this->nbAdults,
            'nb_children_1' => $this->nbChildren,
            'languages'     => array($this->app['context']->getLanguage()),
            'etab_list'     => (is_null($camping)) ? '' : $camping->getCode(),
            'max_results'   => $this->maxResults,
        );
    }
}

<?php

namespace VacancesDirectes\Lib;

use Silex\Application;

use Cungfoo\Model\VilleQuery,
    Cungfoo\Model\EtablissementQuery;

class SearchParams
{
    protected $app;
    protected $themes = array();
    protected $etabs  = array();

    protected $largeScope  = '';
    protected $smallScope  = '';
    protected $startDate   = '';
    protected $endDate     = '';
    protected $nbDays      = '';
    protected $nbAdults    = '';
    protected $nbChildren  = '';
    protected $maxResults  = '';

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

    public function setNbDays($nbDays)
    {
        $this->nbDays = $nbDays;

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

    public function addTheme($theme)
    {
        if ($theme)
        {
            $this->themes[] = $theme;
        }

        return $this;
    }

    public function addEtab($etab)
    {
        if ($etab)
        {
            $this->etabs[] = $etab;
        }

        return $this;
    }

    public function generate()
    {
        $this
            ->manageSmallScope()
            ->addTheme($this->largeScope)
        ;

        $startDate = \DateTime::createFromFormat('Y-m-d', $this->startDate);
        $endDate   = \DateTime::createFromFormat('Y-m-d', $this->endDate);
        $nbDays    = ($this->nbDays != '') ? $this->nbDays : $endDate->diff($startDate)->format('%a');

        return array(
            'search_themes' => implode(',', $this->themes),
            'etab_list'     => implode(',', $this->etabs),
            'start_date'    => $startDate->format('d/m/Y'),
            'nb_days'       => $nbDays,
            'nb_adults'     => $this->nbAdults,
            'nb_children_1' => $this->nbChildren,
            'languages'     => array($this->app['context']->getLanguage()),
            'max_results'   => $this->maxResults,
        );
    }

    protected function manageSmallScope()
    {
        $ville = VilleQuery::create()
            ->filterByCode($this->smallScope)
            ->findOne()
        ;

        if ($ville)
        {
            $this->addTheme($ville->getCode());
        }
        else
        {
            $etab = EtablissementQuery::create()
                ->filterByCode($this->smallScope)
                ->findOne()
            ;

            if ($etab)
            {
                $this->addEtab($etab->getCode());
            }
        }

        return $this;
    }

}

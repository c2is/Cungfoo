<?php

namespace VacancesDirectes\Widget;

use Symfony\Component\HttpFoundation\Request;

use Cungfoo\Model\TopCampingQuery,
    Cungfoo\Widget\AbstractWidget;

class TopCampingWidget extends AbstractWidget
{
    public function getName()
    {
        return 'top_camping';
    }

    public function render()
    {
        $locale = $this->app['context']->get('language');

        $topCampings = \Cungfoo\Model\TopCampingQuery::create()
            ->addAscendingOrderByColumn('sortable_rank')
            ->useEtablissementQuery()
                ->useI18nQuery($locale)
                    ->filterByActiveLocale(true)
                ->endUse()
                ->filterByActive(true)
            ->endUse()
            ->findActive()
        ;

        return $this->app['twig']->render('Widget\\top_camping.twig', array(
            'topCampings' => $topCampings
        ));
    }

    public function getMaxAge()
    {
        return $this->app['config']->get('vd_config')['httpcache']['long'];
    }
}
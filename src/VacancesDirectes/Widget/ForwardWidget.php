<?php

namespace VacancesDirectes\Widget;

use Symfony\Component\HttpFoundation\Request;

use Cungfoo\Model\VosVacancesQuery,
    Cungfoo\Widget\AbstractWidget;

class ForwardWidget extends AbstractWidget
{
    public function getName()
    {
        return 'forward';
    }

    public function render()
    {
        $locale = $this->app['context']->get('language');

        $vosVacances = VosVacancesQuery::create()
            ->useI18nQuery($locale)
                ->filterByActiveLocale(true)
            ->endUse()
            ->findOne()
        ;

        return $this->app['twig']->render('Widget\\forward.twig', array(
            'vosVacances' => $vosVacances
        ));
    }

    public function getMaxAge()
    {
        return $this->app['config']->get('vd_config')['httpcache']['long'];
    }
}

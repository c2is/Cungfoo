<?php

namespace VacancesDirectes\Widget;

use Symfony\Component\HttpFoundation\Request;

use Cungfoo\Model\IdeeWeekendQuery,
    Cungfoo\Widget\AbstractWidget;

class IdeesWeekendWidget extends AbstractWidget
{
    public function getName()
    {
        return 'idees_weekend';
    }

    public function render()
    {
        $ideesWeekend = IdeeWeekendQuery::create()
            ->filterByHome(true)
            ->findActive()
        ;

        return $this->app['twig']->render('Widget\\idees_weekend.twig', array(
            'ideesweekend' => $ideesWeekend,
        ));
    }

    public function getMaxAge()
    {
        return $this->app['config']->get('vd_config')['httpcache']['short'];
    }
}
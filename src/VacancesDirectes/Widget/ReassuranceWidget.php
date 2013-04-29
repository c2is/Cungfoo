<?php

namespace VacancesDirectes\Widget;

use Symfony\Component\HttpFoundation\Request;

use Cungfoo\Widget\AbstractWidget;

class ReassuranceWidget extends AbstractWidget
{
    public function getName()
    {
        return 'reassurance';
    }

    public function render()
    {
        return $this->app['twig']->render('Widget\\reassurance.twig');
    }

    public function getMaxAge()
    {
        return $this->app['config']->get('vd_config')['httpcache']['static'];
    }
}

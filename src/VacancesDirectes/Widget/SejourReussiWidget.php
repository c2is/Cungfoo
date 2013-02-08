<?php

namespace VacancesDirectes\Widget;

use Symfony\Component\HttpFoundation\Request;

use Cungfoo\Widget\AbstractWidget;

class SejourReussiWidget extends AbstractWidget
{
    public function getName()
    {
        return 'sejour_reussi';
    }

    public function render()
    {
        return $this->app['twig']->render('Widget\\sejour_reussi.twig');
    }

    public function getMaxAge()
    {
        return $this->app['config']->get('vd_config')['httpcache']['long'];
    }
}
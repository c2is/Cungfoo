<?php

namespace VacancesDirectes\Widget;

use Symfony\Component\HttpFoundation\Request;

use Cungfoo\Widget\AbstractWidget;

class PropositionHebergementWidget extends AbstractWidget
{
    public function getName()
    {
        return 'proposition_hebergement';
    }

    public function render()
    {
        return $this->app['twig']->render('Widget\\proposition_hebergement.twig');
    }

    public function getMaxAge()
    {
        return $this->app['config']->get('vd_config')['httpcache']['static'];
    }
}

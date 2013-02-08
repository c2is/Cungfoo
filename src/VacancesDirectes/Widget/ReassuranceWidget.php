<?php

namespace VacancesDirectes\Widget;

use Symfony\Component\HttpFoundation\Request;

use Cungfoo\Model\EtablissementQuery,
    Cungfoo\Widget\AbstractWidget;

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
}
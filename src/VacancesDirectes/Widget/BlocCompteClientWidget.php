<?php

namespace VacancesDirectes\Widget;

use Symfony\Component\HttpFoundation\Request;

use Cungfoo\Widget\AbstractWidget;

class BlocCompteClientWidget extends AbstractWidget
{
    public function getName()
    {
        return 'bloc_compte_client';
    }

    public function render()
    {
        return $this->app['twig']->render('Widget\\bloc_compte_client.twig');
    }
}

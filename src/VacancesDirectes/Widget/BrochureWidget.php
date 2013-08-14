<?php

namespace VacancesDirectes\Widget;

use Symfony\Component\HttpFoundation\Request;

use Cungfoo\Widget\AbstractWidget;

class BrochureWidget extends AbstractWidget
{
    public function getName()
    {
        return 'brochure';
    }

    public function render()
    {
        return $this->app['twig']->render('Widget\\brochure.twig');
    }
}

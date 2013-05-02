<?php

namespace VacancesDirectes\Widget;

use Symfony\Component\HttpFoundation\Request;

use Cungfoo\Widget\AbstractWidget;

class ContactWidget extends AbstractWidget
{
    public function getName()
    {
        return 'contact';
    }

    public function render()
    {
        return $this->app['twig']->render('Widget\\contact.twig');
    }

    public function getMaxAge()
    {
        return $this->app['config']->get('vd_config')['httpcache']['static'];
    }
}

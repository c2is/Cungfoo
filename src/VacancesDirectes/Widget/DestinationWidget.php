<?php

namespace VacancesDirectes\Widget;

use Symfony\Component\HttpFoundation\Request;

use Cungfoo\Model\PaysQuery,
    Cungfoo\Widget\AbstractWidget;

class DestinationWidget extends AbstractWidget
{
    public function getName()
    {
        return 'destination';
    }

    public function render()
    {
        $pays = PaysQuery::create()
            ->findActive()
        ;

        return $this->app['twig']->render('Widget\\destination.twig', array(
            'pays' => $pays
        ));
    }

    public function getMaxAge()
    {
        return $this->app['config']->get('vd_config')['httpcache']['long'];
    }
}

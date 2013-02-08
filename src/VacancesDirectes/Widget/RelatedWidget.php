<?php

namespace VacancesDirectes\Widget;

use Symfony\Component\HttpFoundation\Request;

use Cungfoo\Model\EtablissementQuery,
    Cungfoo\Widget\AbstractWidget;

class RelatedWidget extends AbstractWidget
{
    public function requiredParameters()
    {
        return array('etab');
    }

    public function getName()
    {
        return 'related';
    }

    public function render()
    {
        $etab = (int) $this->app['request']->query->get('etab');

        $campings = EtablissementQuery::create()
            ->limit(2)
            ->findActive()
        ;

        return $this->app['twig']->render('Widget\\related.twig', array(
            'campings' => $campings
        ));
    }
}
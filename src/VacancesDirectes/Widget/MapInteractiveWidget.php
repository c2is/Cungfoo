<?php

namespace VacancesDirectes\Widget;

use Symfony\Component\HttpFoundation\Request;

use Cungfoo\Model\ThematiqueQuery,
    Cungfoo\Model\EtablissementQuery,
    Cungfoo\Widget\AbstractWidget;

class MapInteractiveWidget extends AbstractWidget
{
    public function getName()
    {
        return 'map_interactive';
    }

    public function render()
    {
        $locale = $this->app['context']->get('language');

        $thematiques = ThematiqueQuery::create()
            ->joinWithI18n($locale)
            ->findActive()
        ;

        $etablissements = EtablissementQuery::create()
            ->findActive()
        ;

        return $this->app['twig']->render('Widget\\map_interactive.twig', array(
            'thematiques'       => $thematiques,
            'etablissements'    => $etablissements,
        ));
    }

    public function getMaxAge()
    {
        return $this->app['config']->get('vd_config')['httpcache']['long'];
    }
}
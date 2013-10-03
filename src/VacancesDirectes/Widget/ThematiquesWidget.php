<?php

namespace VacancesDirectes\Widget;

use Symfony\Component\HttpFoundation\Request;

use VacancesDirectes\Controller\DestinationQuery,
    Cungfoo\Widget\AbstractWidget;

class ThematiquesWidget extends AbstractWidget
{
    public function getName()
    {
        return 'thematiques';
    }

    public function render()
    {
        $locale = $this->app['context']->get('language');

        $thematiques = \Cungfoo\Model\DestinationQuery::create()
			->joinWithI18n($locale)
            ->findActive()
		;
				
        return $this->app['twig']->render('Widget\\thematiques.twig', array(
            'thematiques' 	=> $thematiques,
			'locale'		=> $locale
        ));
    }
	
    public function getMaxAge()
    {
        return $this->app['config']->get('vd_config')['httpcache']['long'];
    }	
}

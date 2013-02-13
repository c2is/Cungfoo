<?php

namespace VacancesDirectes\Widget;

use Symfony\Component\HttpFoundation\Request;

use Cungfoo\Model\EtablissementQuery,
    Cungfoo\Widget\AbstractWidget;

class SearchFilterWidget extends AbstractWidget
{
    public function getName()
    {
        return 'search_filter';
    }

    public function render()
    {
        $locale = $this->app['context']->get('language');

        $situation = \Cungfoo\Model\SituationGeographiqueQuery::create()
            ->joinWithI18n($locale)
            ->rightJoinEtablissementSituationGeographique()
            ->distinct()
            ->findActive()
        ;

        $baignade = \Cungfoo\Model\BaignadeQuery::create()
            ->joinWithI18n($locale)
            ->rightJoinEtablissementBaignade()
            ->distinct()
            ->findActive()
        ;

        $activites = \Cungfoo\Model\ActiviteQuery::create()
            ->joinWithI18n($locale)
            ->rightJoinEtablissementActivite()
            ->distinct()
            ->findActive()
        ;

        $services = \Cungfoo\Model\ServiceComplementaireQuery::create()
            ->joinWithI18n($locale)
            ->rightJoinEtablissementServiceComplementaire()
            ->distinct()
            ->findActive()
        ;

        $thematiques = \Cungfoo\Model\ThematiqueQuery::create()
            ->joinWithI18n($locale)
            ->rightJoinEtablissementThematique()
            ->distinct()
            ->findActive()
        ;

        $categories = \Cungfoo\Model\CategorieQuery::create()
            ->joinWithI18n($locale)
            ->rightJoinEtablissement()
            ->distinct()
            ->findActive()
        ;

        return $this->app['twig']->render('Widget\\search_filter.twig', array(
            'situation'       => $situation,
            'baignade'       => $baignade,
            'activites'       => $activites,
            'services'       => $services,
            'thematiques'       => $thematiques,
            'categories'       => $categories
        ));
    }
}
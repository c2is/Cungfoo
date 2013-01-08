<?php

namespace VacancesDirectes\Controller;

use Silex\Application,
    Silex\ControllerCollection,
    Silex\ControllerProviderInterface;

use Symfony\Component\HttpFoundation\Request,
    Symfony\Component\HttpKernel\Exception\NotFoundHttpException,
    Symfony\Component\Routing\Route,
    Symfony\Component\HttpFoundation\Response;

class SearchFilterController implements ControllerProviderInterface
{
    /**
     * {@inheritdoc}
     */
    public function connect(Application $app)
    {
        $controllers = $app['controllers_factory'];

        $controllers->match('/filtre', function (Request $request) use ($app)
        {

            $locale = $app['context']->get('language');

            $situation = \Cungfoo\Model\SituationGeographiqueQuery::create()
                ->joinWithI18n($locale)
                ->findActive()
            ;

            $baignade = \Cungfoo\Model\BaignadeQuery::create()
                ->joinWithI18n($locale)
                ->findActive()
            ;

            $activites = \Cungfoo\Model\ActiviteQuery::create()
                ->joinWithI18n($locale)
                ->findActive()
            ;

            $services = \Cungfoo\Model\ServiceComplementaireQuery::create()
                ->joinWithI18n($locale)
                ->findActive()
            ;

            $thematiques = \Cungfoo\Model\ThematiqueQuery::create()
                ->joinWithI18n($locale)
                ->findActive()
            ;

            return $app->renderView('Filtres/filtres.twig', array(
                'situation'       => $situation,
                'baignade'       => $baignade,
                'activites'       => $activites,
                'services'       => $services,
                'thematiques'       => $thematiques
            ));
        })
        ->bind('search_filter');

        return $controllers;
    }
}

<?php

namespace VacancesDirectes\Controller;

use Silex\Application,
    Silex\ControllerCollection,
    Silex\ControllerProviderInterface;

use Symfony\Component\HttpFoundation\Request,
    Symfony\Component\HttpFoundation\Response,
    Symfony\Component\HttpKernel\Exception\NotFoundHttpException,
    Symfony\Component\Routing\Route;

use Cungfoo\Model\EtablissementQuery,
    Cungfoo\Model\DernieresMinutesQuery,
    Cungfoo\Model\IdeeWeekendQuery,
    Cungfoo\Model\ThematiqueQuery,
    Cungfoo\Model\VosVacancesQuery;

use VacancesDirectes\Lib\SearchEngine,
    VacancesDirectes\Lib\PleinActivite;

class HomepageController implements ControllerProviderInterface
{
    /**
     * {@inheritdoc}
     */
    public function connect(Application $app)
    {
        // creates a new controller based on the default route
        $controllers = $app['controllers_factory'];

        $controllers->match('/', function (Request $request) use ($app)
        {

            $searchEngine = new SearchEngine($app, $request);
            $searchEngine->process($app['session']->get('search_engine_data'));
            if ($searchEngine->getRedirect())
            {
                return $app->redirect($searchEngine->getRedirect());
            }

            $locale = $app['context']->get('language');

            $topCampings = \Cungfoo\Model\TopCampingQuery::create()
                ->addAscendingOrderByColumn('sortable_rank')
                ->useEtablissementQuery()
                    ->useI18nQuery($locale)
                        ->filterByActiveLocale(true)
                    ->endUse()
                    ->filterByActive(true)
                ->endUse()
                ->findActive()
            ;

            $mea = \Cungfoo\Model\MiseEnAvantQuery::create()
                ->joinWithI18n($locale)
                ->addAscendingOrderByColumn('sortable_rank')
                ->filterByDateFinValidite(date('Y-m-d H:i:s'), \Criteria::GREATER_EQUAL)
                ->findActive()
            ;

            $pays = \Cungfoo\Model\PaysQuery::create()
                ->findActive()
            ;

            $vosVacances = VosVacancesQuery::create()
                ->useI18nQuery($locale)
                    ->filterByActiveLocale(true)
                ->endUse()
                ->findOne()
            ;

            $thematiques = ThematiqueQuery::create()
                ->joinWithI18n($locale)
                ->findActive()
            ;

            $etablissements = EtablissementQuery::create()
                ->findActive()
            ;

            $pleinActivites = new PleinActivite($app);

            return $view = $app->renderView('homepage.twig', array(
                'searchForm'        => $searchEngine->getView(),
                'locale'            => $locale,
                'topCampings'       => $topCampings,
                'pays'              => $pays,
                'mea'               => $mea,
                'vosVacances'       => $vosVacances,
                'thematiques'       => $thematiques,
                'etablissements'    => $etablissements,
                'pleinActivites'    => $pleinActivites->process(),
                'urlCanonical'      => $app['url_generator']->generate('homepage', array(), true),
            ));
        })
        ->bind('homepage');

        return $controllers;
    }
}

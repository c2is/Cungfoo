<?php

namespace VacancesDirectes\Controller;

use Silex\Application,
    Silex\ControllerCollection,
    Silex\ControllerProviderInterface;

use Symfony\Component\HttpFoundation\Request,
    Symfony\Component\HttpKernel\Exception\NotFoundHttpException,
    Symfony\Component\Routing\Route;

use Cungfoo\Model\EtablissementQuery,
    Cungfoo\Model\DernieresMinutesQuery,
    Cungfoo\Model\IdeeWeekendQuery,
    Cungfoo\Model\ThematiqueQuery,
    Cungfoo\Model\VosVacancesQuery;

use Resalys\Lib\Client\DisponibiliteClient;

use VacancesDirectes\Lib\SearchEngine,
    VacancesDirectes\Lib\SearchParams,
    VacancesDirectes\Lib\PleinActivite,
    VacancesDirectes\Lib\Listing\DispoListing;

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

            $dernieresMinutes = DernieresMinutesQuery::create()
                ->findOne()
            ;

            $vosVacances = VosVacancesQuery::create()
                ->joinWithI18n($locale)
                ->findOne()
            ;

            $ideesweekend = IdeeWeekendQuery::create()
                ->joinWithI18n($locale)
                ->filterByHome(true)
                ->findActive()
            ;

            $thematiques = ThematiqueQuery::create()
                ->joinWithI18n($locale)
                ->findActive()
            ;

            $etablissements = EtablissementQuery::create()
                ->findActive()
            ;

            $baseDate  = $dernieresMinutes->getDateStart('U') ?: date('U');
            $startDate = strtotime('next ' . $dernieresMinutes->getDayStart(), $baseDate);
            $startDate = strtotime('+' . ($dernieresMinutes->getDayRange() - 7) . ' days', $startDate);

            $searchParams = new SearchParams($app);
            $searchParams
                ->setStartDate(date('Y-m-d', $startDate))
                ->setNbDays(7)
                ->addTheme($dernieresMinutes->getDestinationsCodes())
                ->addEtab($dernieresMinutes->getEtablissementsCodes())
                ->setNbAdults(1)
                ->setMaxResults(4)
            ;

            $client = new DisponibiliteClient($app['config']->get('root_dir'));
            $client->addOptions($searchParams->generate());

            $listing = new DispoListing($app);
            $listing->setClient($client);

            $pleinActivites = new PleinActivite($app);

            return $app['twig']->render('homepage.twig', array(
                'searchForm'        => $searchEngine->getView(),
                'locale'            => $locale,
                'topCampings'       => $topCampings,
                'pays'              => $pays,
                'mea'               => $mea,
                'vosVacances'       => $vosVacances,
                'ideesweekend'      => $ideesweekend,
                'thematiques'       => $thematiques,
                'etablissements'    => $etablissements,
                'dernieres_minutes' => $listing->process(),
                'pleinActivites'    => $pleinActivites->process(),
            ));
        })
        ->bind('homepage');

        return $controllers;
    }
}

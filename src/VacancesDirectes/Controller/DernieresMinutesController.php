<?php

namespace VacancesDirectes\Controller;

use Silex\Application,
    Silex\ControllerCollection,
    Silex\ControllerProviderInterface;

use Symfony\Component\HttpFoundation\Request,
    Symfony\Component\HttpKernel\Exception\NotFoundHttpException,
    Symfony\Component\Routing\Route;

use Cungfoo\Model\EtablissementQuery,
    Cungfoo\Model\DernieresMinutesQuery;

use VacancesDirectes\Lib\Listing,
    VacancesDirectes\Lib\SearchEngine,
    VacancesDirectes\Lib\SearchParams,
    VacancesDirectes\Lib\Listing\DispoListing;

use Resalys\Lib\Client\DisponibiliteClient;

class DernieresMinutesController implements ControllerProviderInterface
{
    public function connect(Application $app)
    {
        $controllers = $app['controllers_factory'];

        $controllers->match('/', function (Application $app, Request $request) {

            $searchEngine = new SearchEngine($app, $request);
            $searchEngine->process();
            if ($searchEngine->getRedirect())
            {
                return $app->redirect($searchEngine->getRedirect());
            }

            $dernieresMinutes = DernieresMinutesQuery::create()
                ->findOne()
            ;

            $searchParams = new SearchParams($app);
            $searchParams
                ->setDates(date('Y-m-d', strtotime('2013/07/20 next ' . $dernieresMinutes->getDayStart())))
                ->setNbDays($dernieresMinutes->getDayRange())
                ->addThemes($dernieresMinutes->getDestinationsCodes())
                ->addEtabs($dernieresMinutes->getEtablissementsCodes())
                ->setNbAdults(1)
                ->setMaxResults(5)
            ;

            $client = new DisponibiliteClient($app['config']->get('root_dir'));
            $client->addOptions($searchParams->generate());

            $listing = new DispoListing($app);
            $listing->setClient($client);

            return $app['twig']->render('Results\listing.twig', array(
                'list'       => $listing->process(),
                'searchForm' => $searchEngine->getView(),
            ));
        })
        ->bind('dernieres_minutes');

        return $controllers;
    }
}

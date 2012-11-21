<?php

namespace VacancesDirectes\Controller;

use Silex\Application,
    Silex\ControllerCollection,
    Silex\ControllerProviderInterface;

use Symfony\Component\HttpFoundation\Request,
    Symfony\Component\HttpKernel\Exception\NotFoundHttpException,
    Symfony\Component\Routing\Route;

use Cungfoo\Model\EtablissementQuery,
    Cungfoo\Model\VilleQuery;

use VacancesDirectes\Lib\SearchEngine,
    VacancesDirectes\Lib\SearchParams,
    VacancesDirectes\Lib\Listing\DispoListing;

use Resalys\Lib\Client\DisponibiliteClient;

class DispoController implements ControllerProviderInterface
{
    public function connect(Application $app)
    {
        $controllers = $app['controllers_factory'];

        $controllers->match('/{large}/{start_date}/{end_date}/{nb_adults}/{nb_children}/{small}', function (Application $app, Request $request, $large, $small, $start_date, $end_date, $nb_adults, $nb_children) {
            $searchEngine = new SearchEngine($app, $request);
            $searchEngine->process();
            if ($searchEngine->getRedirect())
            {
                return $app->redirect($searchEngine->getRedirect());
            }

            $searchParams = new SearchParams($app);
            $searchParams
                ->setLargeScope($large)
                ->setSmallScope($small)
                ->setDates($start_date, $end_date)
                ->setNbAdults($nb_adults)
                ->setNbChildren($nb_children)
            ;

            $client = new DisponibiliteClient($app['config']->get('root_dir'));
            $client->addOptions($searchParams->generate());

            $listing = new DispoListing($app);
            $listing
                ->setClient($client)
                ->setType(DispoListing::DISPO)
            ;

            return $app['twig']->render('Results\listing.twig', array(
                'list'       => $listing->process(),
                'searchForm' => $searchEngine->getView(),
            ));
        })
        ->value('nb_children', 0)
        ->value('small', null)
        ->bind('dispo');

        return $controllers;
    }
}

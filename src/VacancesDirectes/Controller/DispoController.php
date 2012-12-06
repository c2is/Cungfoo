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

        $controllers->match('/{large}/{start_date}/{nb_days}/{nb_adults}/{nb_children}/{small}', function (Application $app, Request $request, $large, $small, $start_date, $nb_days, $nb_adults, $nb_children) {
            $searchEngine = new SearchEngine($app, $request);
            $searchEngine->process($app['session']->get('search_engine_data'));
            if ($searchEngine->getRedirect())
            {
                return $app->redirect($searchEngine->getRedirect());
            }

            $searchParams = new SearchParams($app);
            $searchParams
                ->setLargeScope($large)
                ->setSmallScope($small)
                ->setStartDate($start_date)
                ->setNbDays($nb_days)
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

            $listingContent = $listing->process();

            return $app->renderView('Research\dispo.twig', array(
                'title'           => $app->trans('seo.title.dispo'),
                'metaDescription' => $app->trans('seo.meta.dispo'),
                'list'            => $listingContent,
                'firstEtab'       => reset($listingContent['element']),
                'searchForm'      => $searchEngine->getView(),
            ));
        })
        ->value('nb_children', 0)
        ->value('small', null)
        ->bind('dispo');

        return $controllers;
    }
}

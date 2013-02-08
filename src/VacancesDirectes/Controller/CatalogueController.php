<?php

namespace VacancesDirectes\Controller;

use Silex\Application,
    Silex\ControllerCollection,
    Silex\ControllerProviderInterface;

use Symfony\Component\HttpFoundation\Request,
    Symfony\Component\HttpKernel\Exception\NotFoundHttpException,
    Symfony\Component\Routing\Route;

use Cungfoo\Model\EtablissementQuery,
    Cungfoo\Model\PaysQuery,
    Cungfoo\Model\RegionQuery,
    Cungfoo\Model\VilleQuery;

use VacancesDirectes\Lib\Listing\CatalogueListing,
    VacancesDirectes\Lib\SearchEngine;

class CatalogueController implements ControllerProviderInterface
{
    public function connect(Application $app)
    {
        $controllers = $app['controllers_factory'];

        $controllers->match('/{large}/{small}', function (Application $app, Request $request, $large, $small) {
            // Formulaire de recherche
            $searchEngine = new SearchEngine($app, $request);
            $searchEngine->process($app['session']->get('search_engine_data'));
            if ($searchEngine->getRedirect())
            {
                return $app->redirect($searchEngine->getRedirect());
            }

            // Recherche
            $pays    = null;
            $region  = null;
            $ville   = null;
            $camping = null;

            // Pays ou région
            $pays = PaysQuery::create()
                ->filterByCode($large)
                ->findOne()
            ;

            if (!$pays)
            {
                $region = RegionQuery::create()
                    ->filterByCode($large)
                    ->findOne()
                ;

                if (!$region)
                {
                    die("faire une exception : pas de pays ou de région");
                }
            }

            // Ville ou camping
            $ville = VilleQuery::create()
                ->filterByCode($small)
                ->findOne()
            ;

            if (!$ville)
            {
                $camping = EtablissementQuery::create()
                    ->filterByCode($small)
                    ->findOne()
                ;
            }

            $searchQuery = EtablissementQuery::create();

            if ($pays)
            {
                $searchQuery
                    ->useVilleQuery()
                        ->useRegionQuery()
                            ->filterByPays($pays)
                        ->endUse()
                    ->endUse()
                ;
            }

            if ($region)
            {
                $searchQuery
                    ->useVilleQuery()
                        ->filterByRegion($region)
                    ->endUse()
                ;
            }

            if ($ville)
            {
                $searchQuery->filterByVille($ville);
            }

            if ($camping)
            {
                $searchQuery->filterById($camping->getId());
            }

            $etabs = $searchQuery->findActive();

            // Création de la liste
            $list = new CatalogueListing($app);
            $list
                ->setData($etabs)
                ->setType(CatalogueListing::CATALOGUE)
            ;

            $listingContent = $list->process();

            return $app->renderView('Research\catalogue.twig', array(
                'list' => $listingContent,
                'firstEtab' => reset($listingContent['element']),
                'searchForm' => $searchEngine->getView(),
            ));
        })
        ->value('small', null)
        ->bind('catalogue');

        return $controllers;
    }
}

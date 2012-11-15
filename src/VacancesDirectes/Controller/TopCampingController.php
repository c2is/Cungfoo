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

use VacancesDirectes\Lib\Listing,
    VacancesDirectes\Lib\SearchEngine;

class TopCampingController
{
    public function indexAction(Request $request, Application $app)
    {
        // Formulaire de recherche
        $searchEngine = new SearchEngine($app, $request);
        $searchEngine->process();
        if ($searchEngine->getRedirect())
        {
            return $app->redirect($searchEngine->getRedirect());
        }

        $topCampings = \Cungfoo\Model\TopCampingQuery::create()
            ->addAscendingOrderByColumn('sortable_rank')
            ->find()
        ;

        $etabs = array();
        foreach ($topCampings as $topCamping)
        {
            $etabs[] = $topCamping->getEtablissement();
        }

        // Création de la liste
        $list = new Listing($app);
        $list
            ->setEtablissements($etabs)
            ->setType(Listing::CATALOGUE)
        ;

        return $app['twig']->render('Results\listing.twig', array(
            'list' => $list->process(),
            'searchForm' => $searchEngine->getView(),
        ));
    }
}

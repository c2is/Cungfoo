<?php

namespace VacancesDirectes\Controller;

use Silex\Application,
    Silex\ControllerCollection,
    Silex\ControllerProviderInterface;

use Symfony\Component\HttpFoundation\Request,
    Symfony\Component\HttpKernel\Exception\NotFoundHttpException,
    Symfony\Component\Routing\Route;

use Cungfoo\Model\EtablissementQuery;

use VacancesDirectes\Lib\Listing,
    VacancesDirectes\Lib\SearchEngine;

class DispoController implements ControllerProviderInterface
{
    public function connect(Application $app)
    {
        $controllers = $app['controllers_factory'];

        $controllers->match('/{large}/{small}/{start_date}/{end_date}/{nb_adults}/{nb_children}', function (Application $app, Request $request, $large, $small, $start_date, $end_date, $nb_adults, $nb_children) {

            // Formulaire de recherche
            $searchEngine = new SearchEngine($app, $request);
            $searchEngine->process();
            if ($searchEngine->getRedirect())
            {
                return $app->redirect($searchEngine->getRedirect());
            }

            $etabs = EtablissementQuery::create()
                ->filterByCode(4)
                ->find()
            ;

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
        })
        ->value('nb_children', null)
        ->bind('dispo');

        return $controllers;
    }
}

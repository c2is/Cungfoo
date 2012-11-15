<?php

namespace VacancesDirectes\Controller;

use Silex\Application,
    Silex\ControllerCollection,
    Silex\ControllerProviderInterface;

use Symfony\Component\HttpFoundation\Request,
    Symfony\Component\HttpKernel\Exception\NotFoundHttpException,
    Symfony\Component\Routing\Route;

use VacancesDirectes\Lib\SearchEngine;

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
            $searchEngine->process();
            if ($searchEngine->getRedirect())
            {
                return $app->redirect($searchEngine->getRedirect());
            }

            $locale = $app['context']->get('language');

            $topCampings = \Cungfoo\Model\TopCampingQuery::create()
                ->addAscendingOrderByColumn('sortable_rank')
                ->find()
            ;

            $mea = \Cungfoo\Model\MiseEnAvantQuery::create()
                ->addAscendingOrderByColumn('sortable_rank')
                ->filterByDateFinValidite(date('Y-m-d H:i:s'), \Criteria::GREATER_EQUAL)
                ->find()
            ;

            $pays = \Cungfoo\Model\PaysQuery::create()
                ->find()
            ;

            return $app['twig']->render('homepage.twig', array(
                'searchForm'  => $searchEngine->getView(),
                'locale'      => $locale,
                'topCampings' => $topCampings,
                'pays'        => $pays,
                'mea'         => $mea
            ));
        })
        ->bind('homepage');

        return $controllers;
    }
}

<?php

namespace VacancesDirectes\Controller;

use Silex\Application,
    Silex\ControllerCollection,
    Silex\ControllerProviderInterface;

use Symfony\Component\HttpFoundation\Request,
    Symfony\Component\HttpKernel\Exception\NotFoundHttpException,
    Symfony\Component\Routing\Route;


use VacancesDirectes\Form\Type\Search\DateType,
    VacancesDirectes\Form\Data\Search\DateData;

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
            $locale = $app['context']->get('language');

            $topCampings = \Cungfoo\Model\TopCampingQuery::create()
                ->addAscendingOrderByColumn('sortable_rank')
                ->limit(3)
                ->find()
            ;

            return $app['twig']->render('homepage.twig', array(
                'locale'       => $locale,
                'topCampings'   => $topCampings,
            ));
        })
        ->bind('homepage');

        return $controllers;
    }
}

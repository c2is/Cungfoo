<?php

namespace VacancesDirectes\Controller;

use Silex\Application,
    Silex\ControllerCollection,
    Silex\ControllerProviderInterface;

use Symfony\Component\HttpFoundation\Request,
    Symfony\Component\HttpKernel\Exception\NotFoundHttpException,
    Symfony\Component\Routing\Route;

class MenuController implements ControllerProviderInterface
{
    /**
     * {@inheritdoc}
     */
    public function connect(Application $app)
    {
        // creates a new controller based on the default route
        $controllers = $app['controllers_factory'];

        $controllers->get('/destinations', function () use ($app)
        {
            return $app['twig']->render('Menu/destinations.twig');
        })
        ->bind('menu_destinations');

        $controllers->get('/locations', function () use ($app)
        {
            return $app['twig']->render('Menu/locations.twig');
        })
        ->bind('menu_locations');

        $controllers->get('/bons-plans', function () use ($app)
        {
            return $app['twig']->render('Menu/bonsPlans.twig');
        })
        ->bind('menu_bons_plans');

        $controllers->get('/vacances', function () use ($app)
        {
            return $app['twig']->render('Menu/vacances.twig');
        })
        ->bind('menu_vacances');

        $controllers->get('/weekends', function () use ($app)
        {
            return $app['twig']->render('Menu/weekends.twig');
        })
        ->bind('menu_weekends');

        return $controllers;
    }
}

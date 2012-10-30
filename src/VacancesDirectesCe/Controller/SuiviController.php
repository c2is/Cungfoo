<?php

namespace VacancesDirectesCe\Controller;

use Silex\Application,
    Silex\ControllerCollection,
    Silex\ControllerProviderInterface;

use Symfony\Component\HttpFoundation\Request,
    Symfony\Component\HttpKernel\Exception\NotFoundHttpException,
    Symfony\Component\HttpFoundation\Response,
    Symfony\Component\Routing\Route;

class SuiviController implements ControllerProviderInterface
{
    /**
     * {@inheritdoc}
     */
    public function connect(Application $app)
    {
        // creates a new controller based on the default route
        $controllers = $app['controllers_factory'];

        $controllers->match('/reservations.html', function (Request $request) use ($app)
        {
            return $app['twig']->render('Modeles/suiviReservations.twig');
        })
        ->bind('suivi_reservations');

        $controllers->match('/achats.html', function (Request $request) use ($app)
        {
            return $app['twig']->render('Modeles/suiviAchats.twig');
        })
        ->bind('suivi_achats');

        return $controllers;
    }
}

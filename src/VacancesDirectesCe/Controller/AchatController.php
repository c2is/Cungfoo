<?php

namespace VacancesDirectesCe\Controller;

use Silex\Application,
    Silex\ControllerCollection,
    Silex\ControllerProviderInterface;

use Symfony\Component\HttpFoundation\Request,
    Symfony\Component\HttpKernel\Exception\NotFoundHttpException,
    Symfony\Component\HttpFoundation\Response,
    Symfony\Component\Routing\Route;

class AchatController implements ControllerProviderInterface
{
    /**
     * {@inheritdoc}
     */
    public function connect(Application $app)
    {
        // creates a new controller based on the default route
        $controllers = $app['controllers_factory'];

        $controllers->match('/packages.html', function (Request $request) use ($app)
        {


            return $app['twig']->render('Achat/packages.twig');
        })
        ->bind('achat_packages');

        $controllers->match('/panier.html', function (Request $request) use ($app)
        {
            $queryString = http_build_query($request->request->all(), '', '&');

            return $app['twig']->render('Achat/panier.twig', array('queryString' => $queryString));
        })
        ->bind('achat_panier');

        $controllers->match('/confirmation-reservation.html', function (Request $request) use ($app)
        {
            $queryString = http_build_query($request->request->all(), '', '&');

            return $app['twig']->render('Achat/confirmation.twig', array('queryString' => $queryString));
        })
        ->bind('achat_confirmation_reservation');

        return $controllers;
    }
}

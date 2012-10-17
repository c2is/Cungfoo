<?php

namespace VacancesDirectesCe\Controller;

use Silex\Application,
    Silex\ControllerCollection,
    Silex\ControllerProviderInterface;

use Symfony\Component\HttpFoundation\Request,
    Symfony\Component\HttpKernel\Exception\NotFoundHttpException,
    Symfony\Component\HttpFoundation\Response,
    Symfony\Component\Routing\Route;

use VacancesDirectesCe\Form\Data\AchatLineaireData,
    VacancesDirectesCe\Form\Type\AchatLineaireType;

class RequestController implements ControllerProviderInterface
{
    /**
     * {@inheritdoc}
     */
    public function connect(Application $app)
    {
        // creates a new controller based on the default route
        $controllers = $app['controllers_factory'];

        $controllers->match('/identifiant.html', function (Request $request) use ($app)
        {
            return $app['twig']->render('Request/identifiant.twig');
        })->bind('request_identifiant');

        $controllers->match('/mot-de-passe.html', function (Request $request) use ($app)
        {
            return $app['twig']->render('Request/motDePasse.twig');
        })->bind('request_password');

        return $controllers;
    }
}

<?php

namespace VacancesDirectesCe\Controller;

use Silex\Application,
    Silex\ControllerCollection,
    Silex\ControllerProviderInterface;

use Symfony\Component\HttpFoundation\Request,
    Symfony\Component\HttpKernel\Exception\NotFoundHttpException,
    Symfony\Component\HttpFoundation\Response,
    Symfony\Component\Routing\Route;

class AdministrationController implements ControllerProviderInterface
{
    /**
     * {@inheritdoc}
     */
    public function connect(Application $app)
    {
        // creates a new controller based on the default route
        $controllers = $app['controllers_factory'];

        $controllers->match('/coordonnees.html', function (Request $request) use ($app)
        {
            return $app['twig']->render('Modeles/coordonnees.twig');
        })
        ->bind('administration_coordonnees');

        $controllers->match('/adherents.html', function (Request $request) use ($app)
        {
            return $app['twig']->render('Modeles/adherents.twig');
        })
        ->bind('administration_adherents');

        $controllers->match('/adherents/ajout.html', function (Request $request) use ($app)
        {
            $queryParameters   = $request->query->all();
            $requestParameters = $request->request->all();

            $queryString = http_build_query($requestParameters, '', '&');

            return $app['twig']->render('Modeles/adherentAjout.twig', array('queryString' => $queryString));
        })
        ->bind('administration_adherents_ajout');

        return $controllers;
    }
}

<?php

namespace VacancesDirectes\Controller;

use Silex\Application,
    Silex\ControllerCollection,
    Silex\ControllerProviderInterface;

use Symfony\Component\HttpFoundation\Request,
    Symfony\Component\HttpKernel\Exception\NotFoundHttpException,
    Symfony\Component\HttpFoundation\Response,
    Symfony\Component\Routing\Route;

use Cungfoo\Model\EtablissementQuery,
    Cungfoo\Model\PointInteretPeer,
    Cungfoo\Model\EventPeer;

class BonsPlansController implements ControllerProviderInterface
{
    /**
     * {@inheritdoc}
     */
    public function connect(Application $app)
    {
        $controllers = $app['controllers_factory'];

        $controllers->match('/camping-ascension/', function (Request $request) use ($app)
        {
            return $app['twig']->render('BonsPlans/index.twig', array(
                'title' => "Camping pont de l'ascension"
            ));

        })->bind('bonsplans_ascension');

        $controllers->match('/camping-8-mai/', function (Request $request) use ($app)
        {
            return $app['twig']->render('BonsPlans/index.twig', array(
                'title' => "Camping pont du 8 mai"
            ));

        })->bind('bonsplans_8mai');

        $controllers->match('/camping-1er-mai/', function (Request $request) use ($app)
        {
            return $app['twig']->render('BonsPlans/index.twig', array(
                'title' => "Camping pont du 1er mai"
            ));

        })->bind('bonsplans_1mai');

        $controllers->match('/camping-pentecote/', function (Request $request) use ($app)
        {
            return $app['twig']->render('BonsPlans/index.twig', array(
                'title' => "Camping pont de la pentecote"
            ));

        })->bind('bonsplans_pentecote');

        return $controllers;
    }
}

<?php

namespace Cungfoo\Controller;

use Silex\Application,
    Silex\ControllerCollection,
    Silex\ControllerProviderInterface;

use Symfony\Component\HttpFoundation\Request,
    Symfony\Component\HttpKernel\Exception\NotFoundHttpException,
    Symfony\Component\Routing\Route;

use Cungfoo\Lib\Job\CatalogueClientJobHandler,
    Cungfoo\Lib\Job\PrixJobHandler,
    Cungfoo\Model\Job;

/**
 * Resalys controllers provider.
 *
 * @author  Morgan Brunot <brunot.morgan@gmail.com>
 */
class ResalysController implements ControllerProviderInterface
{
    public function connect(Application $app)
    {
        // creates a new controller based on the default route
        $controllers = $app['controllers_factory'];

        $controllers->get('/', function (Application $app) {
            return $app['twig']->render('Resalys/parameters.twig');
        })
        ->bind('resalys_actions');

        $controllers->get('/import', function (Application $app) {
            // ajout du job d'import des données Resalys
            $jobImport = new Job();
            $jobImport
                ->setType(CatalogueClientJobHandler::getName())
                ->save()
            ;

            return $app->redirect($app['url_generator']->generate('resalys_actions'));
        })
        ->bind('resalys_actions_import');

        $controllers->get('/import/prix', function (Application $app) {
            $jobImport = new Job();
            $jobImport
                ->setType(PrixJobHandler::getName())
                ->save()
            ;

            return $app->redirect($app['url_generator']->generate('resalys_actions'));
        })
        ->bind('resalys_actions_import_prix');

        return $controllers;
    }
}

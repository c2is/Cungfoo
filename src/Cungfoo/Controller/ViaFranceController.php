<?php

namespace Cungfoo\Controller;

use Silex\Application,
    Silex\ControllerCollection,
    Silex\ControllerProviderInterface;

use Symfony\Component\HttpFoundation\Request,
    Symfony\Component\HttpKernel\Exception\NotFoundHttpException,
    Symfony\Component\Routing\Route;

use Cungfoo\Lib\Job\EventJobHandler,
    Cungfoo\Model\Job;

/**
 * Resalys controllers provider.
 *
 * @author  Morgan Brunot <brunot.morgan@gmail.com>
 */
class ViaFranceController implements ControllerProviderInterface
{
    public function connect(Application $app)
    {
        // creates a new controller based on the default route
        $controllers = $app['controllers_factory'];

        $controllers->get('/', function (Application $app) {
            return $app['twig']->render('ViaFrance/parameters.twig');
        })
        ->bind('viafrance_actions');

        $controllers->get('/import/events', function (Application $app) {
            $jobImport = new Job();
            $jobImport
                ->setType(EventJobHandler::getName())
                ->save()
            ;

            return $app->redirect($app['url_generator']->generate('viafrance_actions'));
        })
        ->bind('viafrance_actions_import_events');

        return $controllers;
    }
}

<?php

namespace Cungfoo\Controller;

use Silex\Application,
    Silex\ControllerCollection,
    Silex\ControllerProviderInterface;

use Symfony\Component\Yaml\Yaml,
    Symfony\Component\HttpFoundation\Request;

/**
 * 
 */
class PurgeController implements ControllerProviderInterface
{

    /**
     * {@inheritdoc}
     */
    public function connect(Application $app)
    {
        $controllers = $app['controllers_factory'];

        $controllers->match('/', function (Request $request) use ($app)
        {
			$result = shell_exec('cd .. && ./clear_cache.sh');
			if(empty($result)) $query['result'] = $app->trans('purge_erreur');
			else $query['result'] = $result;
			return $app->renderView('Purge/index.twig', array('query' => $query));
        })
        ->bind('purge_actions');

        return $controllers;
    }
}
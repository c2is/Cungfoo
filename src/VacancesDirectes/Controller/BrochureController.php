<?php

namespace VacancesDirectes\Controller;

use Silex\Application,
    Silex\ControllerCollection,
    Silex\ControllerProviderInterface;

use Symfony\Component\HttpFoundation\Request,
    Symfony\Component\HttpKernel\Exception\NotFoundHttpException,
    Symfony\Component\HttpFoundation\Response,
    Symfony\Component\Routing\Route;

class BrochureController implements ControllerProviderInterface{

	protected function getDefaultResalysParameters(Application $app, Request $request)
    {
        $rslConfig = $app['config']->get('rsl_config')['services']['disponibilite']['default_envelope'];
        if (isset($app['config']->get('languages')[$app['context']->get('language')]) && isset($app['config']->get('languages')[$app['context']->get('language')]['resalys_username']))
        {
            $rslConfig['username'] = $app['config']->get('languages')[$app['context']->get('language')]['resalys_username'];
        }

        $parameters = array(
            "specificFiles" => 'brochure',
            "base_id"       => $rslConfig['base_id'],
            "webuser"       => $rslConfig['username'],
            "tokens"        => 'ignore_token',
            "actions"       => $request->query->get('actions'),
            "tokens"        => $request->query->get('tokens'),
        );

        $query = array_merge($parameters, $request->request->all());

        return $query;
    }
	/**
	* {@inheritdoc}
    */
	
    public function connect(Application $app)
    {
		$controllers = $app['controllers_factory'];
		
		$controllers->match('/', function (Request $request) use ($app)
        {
			
            $query            = $this->getDefaultResalysParameters($app, $request);
            $query['display'] = 'request';
			$query['request_type'] = 'booklet';
			
            return $app->renderView('Brochure/index.twig', array('query' => $query));

        })->bind('demande_brochure');

		return $controllers;
    }
}

<?php

namespace VacancesDirectes\Controller;

use Silex\Application,
    Silex\ControllerCollection,
    Silex\ControllerProviderInterface;

use Symfony\Component\HttpFoundation\Request,
    Symfony\Component\HttpKernel\Exception\NotFoundHttpException,
    Symfony\Component\HttpFoundation\Response,
    Symfony\Component\Routing\Route;

class CompteController implements ControllerProviderInterface
{
    protected function getDefaultResalysParameters(Application $app, Request $request)
    {
        $rslConfig = $app['config']->get('rsl_config')['services']['disponibilite']['default_envelope'];
        if (isset($app['config']->get('languages')[$app['context']->get('language')]) && isset($app['config']->get('languages')[$app['context']->get('language')]['resalys_username']))
        {
            $rslConfig['username'] = $app['config']->get('languages')[$app['context']->get('language')]['resalys_username'];
        }

        $parameters = array(
            "specificFiles" => 'compte',
            "base_id"       => $rslConfig['base_id'],
            "webuser"       => $rslConfig['username'],
            "tokens"        => 'ignore_token',
            "actions"       => $request->query->get('actions'),
            "tokens"        => $request->query->get('tokens'),
            "session"       => $app['session']->get('resalys_user')->session,
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
            $query['display'] = 'customer_area';

            return $app->renderView('Compte/index.twig', array('query' => $query));

        })->bind('compte_index');

        $controllers->match('/' . $app->trans('seo.url.compte.coordonnees') . '/', function (Request $request) use ($app)
        {
            $query            = $this->getDefaultResalysParameters($app, $request);
            $query['display'] = 'edit_customer_info';

            return $app->renderView('Compte/index.twig', array('query' => $query));

        })->bind('compte_coordonnees');

        $controllers->match('/' . $app->trans('seo.url.compte.brochure') . '/', function (Request $request) use ($app)
        {
            $query            = $this->getDefaultResalysParameters($app, $request);
            $query['display'] = 'request';
            $query['request_type'] = 'booklet';

            return $app->renderView('Compte/index.twig', array('query' => $query));

        })->bind('compte_brochure');

        $controllers->match('/' . $app->trans('seo.url.compte.reservations') . '/', function (Request $request) use ($app)
        {

			$gateway_messages = array('LANG_ogone_canceled', 'LANG_ogone_declined', 'LANG_ogone_exception', 'LANG_ogone_accepted');
			
            $query              = $this->getDefaultResalysParameters($app, $request);
            $query['display']   = 'existing_reservations';
            $query['homeLink']  = $app['url_generator']->generate('homepage', array(), true);
			$query['confirmation']  = $app['url_generator']->generate('compte_reservations', array(), true);
			$query['ogone_accepted_route'] = '/'.$app->trans('seo.url.compte.index').'/'.$app->trans('seo.url.compte.reservations').'/';
			$query['ogone_back_route'] 	= '/'.$app->trans('seo.url.compte.index').'/'.$app->trans('seo.url.compte.reservations').'/';
			
			if(in_array($request->query->get('gateway_message'),$gateway_messages)) 
				$query['gateway_message'] = $request->query->get('gateway_message');
				
            return $app->renderView('Compte/index.twig', array('query' => $query));

        })->bind('compte_reservations');

        $controllers->match('/' . $app->trans('seo.url.compte.fidelite') . '/', function (Request $request) use ($app)
        {
            $query            = $this->getDefaultResalysParameters($app, $request);
            $query['display'] = 'fidelity_point_list';

            return $app->renderView('Compte/index.twig', array('query' => $query));

        })->bind('compte_fidelite');

        $controllers->match('/' . $app->trans('seo.url.compte.parrainage') . '/', function (Request $request) use ($app)
        {
            $query            = $this->getDefaultResalysParameters($app, $request);
            $query['display'] = 'sponsorship';

            return $app->renderView('Compte/index.twig', array('query' => $query));

        })->bind('compte_parrainage');

        return $controllers;
    }
}

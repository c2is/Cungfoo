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

        $parameters = array(
            "specificFiles" => 'compte',
            "base_id"       => $rslConfig['base_id'],
            "webuser"       => $rslConfig['username'],
            "tokens"        => 'ignore_token',
            "actions"       => $request->query->get('actions'),
            "tokens"        => $request->query->get('tokens'),
            "session"       => $app['session']->get('resalys_user')->session,
        );

        return array_merge($parameters, $request->request->all());
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

        $controllers->match('/coordonnees/', function (Request $request) use ($app)
        {
            $query            = $this->getDefaultResalysParameters($app, $request);
            $query['display'] = 'edit_customer_info';

            return $app->renderView('Compte/index.twig', array('query' => $query));

        })->bind('compte_coordonnees');

        $controllers->match('/demande-brochure/', function (Request $request) use ($app)
        {
            $query            = $this->getDefaultResalysParameters($app, $request);
            $query['display'] = 'request';

            return $app->renderView('Compte/index.twig', array('query' => $query));

        })->bind('compte_brochure');

        $controllers->match('/reservations/', function (Request $request) use ($app)
        {
            $query            = $this->getDefaultResalysParameters($app, $request);
            $query['display'] = 'existing_reservations';

            return $app->renderView('Compte/index.twig', array('query' => $query));

        })->bind('compte_reservations');

        $controllers->match('/avantages-fidelite/', function (Request $request) use ($app)
        {
            $query            = $this->getDefaultResalysParameters($app, $request);
            $query['display'] = 'fidelity_point_list';

            return $app->renderView('Compte/index.twig', array('query' => $query));

        })->bind('compte_fidelite');

        $controllers->match('/parrainage/', function (Request $request) use ($app)
        {
            $query            = $this->getDefaultResalysParameters($app, $request);
            $query['display'] = 'sponsorship';

            return $app->renderView('Compte/index.twig', array('query' => $query));

        })->bind('compte_parrainage');

        return $controllers;
    }
}

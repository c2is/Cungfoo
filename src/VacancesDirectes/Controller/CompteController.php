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
    /**
     * {@inheritdoc}
     */
    public function connect(Application $app)
    {
        $controllers = $app['controllers_factory'];

        $controllers->match('/', function (Request $request) use ($app)
        {
            $query = array(
                "specificFiles" => 'couloir',
                "base_id"       => 'vacancesdirectes_preprod_v6_6',
                "webuser"       => 'web_fr',
                "tokens"        => 'ignore_token',
                "display"       => 'customer_area',
                "actions"       => $request->query->get('actions'),
                "session"       => $request->query->get('session'),
                "tokens"        => $request->query->get('tokens'),
                "session"       => $app['session']->get('resalys_user')->session,
            );

            $query = array_merge($query, $request->request->all());

            return $app->renderView('Compte/index.twig', array('query' => $query));

        })->bind('compte_index');

        return $controllers;
    }
}

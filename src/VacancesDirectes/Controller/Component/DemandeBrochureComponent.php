<?php

namespace VacancesDirectes\Controller\Component;

use Silex\Application;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Route;

class DemandeBrochureComponent
{
    public static function render(Application $app, Request $request)
    {
        $rslConfig = $app['config']->get('rsl_config')['services']['disponibilite']['default_envelope'];

        if (isset($app['config']->get('languages')[$app['context']->get('language')]) && isset($app['config']->get('languages')[$app['context']->get('language')]['resalys_username'])) {
            $rslConfig['username'] = $app['config']->get('languages')[$app['context']->get('language')]['resalys_username'];
        }

        $rslConfig['iframe']        = 1;
        $rslConfig['webuser']       = $rslConfig['username'];
        $rslConfig['display']       = 'request';
        $rslConfig['request_type']  = 'booklet';
        $rslConfig['convention_id'] = 360;

        return $app['twig']->render('Component\demande_brochure.html.twig', array(
            'query' => $rslConfig,
        ));
    }
}

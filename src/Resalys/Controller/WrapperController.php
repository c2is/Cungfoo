<?php

namespace Resalys\Controller;

use Silex\Application,
    Silex\ControllerCollection,
    Silex\ControllerProviderInterface;

use Symfony\Component\HttpFoundation\Request,
    Symfony\Component\HttpKernel\Exception\NotFoundHttpException,
    Symfony\Component\HttpFoundation\Response,
    Symfony\Component\Routing\Route;

class WrapperController implements ControllerProviderInterface
{
    /**
     * {@inheritdoc}
     */
    public function connect(Application $app)
    {
        // creates a new controller based on the default route
        $controllers = $app['controllers_factory'];

        $controllers->match('/wrapper', function (Request $request) use ($app)
        {
            $queryString = $request->getQueryString();

            $iframe = file_get_contents(sprintf("http://preprod.vacances-directes.com/rsl/clickbooking?%s", $queryString));

            $modifiedIframe = str_replace(array(
                '##TESTC2IS##',
            ), array(
                'TAC TAC T\'AS VU',
            ), $iframe);

            return new Response($modifiedIframe);
        })
        ->bind('resalys_wrapper');

        return $controllers;
    }
}

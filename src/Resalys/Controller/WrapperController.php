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
                '{_c2is.stylesheet}'
            ), array(
                $this->getStylesheetTag('css/vacancesdirectes/iframe.css', $app, $request)
            ), $iframe);

            return new Response($modifiedIframe);
        })
        ->bind('resalys_wrapper');

        return $controllers;
    }

    public function getStylesheetTag($url, $app, Request $request)
    {
        $asset = $app['twig']->getExtension('asset')->asset($url);
        return sprintf('<link rel="stylesheet" href="%s://%s%s">', $request->getScheme(), $request->getHttpHost(), $asset);
    }
}

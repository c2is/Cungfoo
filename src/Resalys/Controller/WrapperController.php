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
            $websiteUri  = rtrim($app['url_generator']->generate('homepage', array(), true), '/');

            $iframe = file_get_contents(sprintf("http://preprod.vacances-directes.com/rsl/clickbooking?%s", $queryString));

            $iframe = $this->replaceUri($iframe, $websiteUri);

            $iframe = str_replace(array(
                '{_c2is.uri}',
                '{_c2is.stylesheet}',
            ), array(
                $websiteUri,
                $this->getStylesheetTag('css/vacancesdirectes/iframe.css', $app, $request),
            ), $iframe);

            return new Response($iframe);
        })
        ->bind('resalys_wrapper');

        return $controllers;
    }

    public function replaceUri($iframe, $uri)
    {
        $matches = null;

        if (preg_match_all('"{_c2is.replace.uri, \'(.*)\', \'(.*)\'}"', $iframe, $matches, PREG_SET_ORDER))
        {
            foreach ($matches as $match)
            {
                $newUri = str_replace($match[1], $uri, $match[2]);
                $iframe = str_replace($match[0], $newUri, $iframe);
            }
        }

        return $iframe;
    }

    public function getStylesheetTag($url, $app, Request $request)
    {
        $asset = $app['twig']->getExtension('asset')->asset($url);
        return sprintf('<link rel="stylesheet" href="%s://%s%s">', $request->getScheme(), $request->getHttpHost(), $asset);
    }
}

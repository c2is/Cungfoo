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

            // define javascript header source code
            $javascriptHeader = sprintf(<<<eof
<script src="%s"></script>
<script>var templatePath = '%s';</script><!-- templatePath : chemin du template en absolue -->
eof
, $this->getAsset('vendor/head.extended.js', $app, $request)
, $this->getAsset('', $app, $request));

            // define javascript footer source code
            $javascriptFooter = sprintf(<<<eof
    <script>
        head.js(
            {modernizr: templatePath+"vendor/modernizr-2.6.1.min.js"}, // test support html5 functionality
            {selectivizr: templatePath+"vendor/selectivizr-min.js"}, // extend css selectors for IE
            {jqPlugins: templatePath+"js/vacancesdirectes/plugins.js"},
            {frontJS: templatePath+"js/vacancesdirectes/iframe/front.js"},
            {iframeJS: templatePath+"js/vacancesdirectes/iframe.js"}
        );
    </script>

    <!-- Prompt IE 6/7 users to install Chrome Frame -->
    <!--[if lt IE 8 ]>
    <script src="//ajax.googleapis.com/ajax/libs/chrome-frame/1.0.3/CFInstall.min.js"></script>
    <script>window.attachEvent('onload',function(){CFInstall.check({mode:'overlay'})})</script>
    <![endif]-->
eof
);

            $iframe = str_replace(array(
                '{_c2is.uri}',
                '{_c2is.stylesheet}',
                '{_c2is.javascript.header}',
                '{_c2is.javascript.footer}',
                '<b><b>',
            ), array(
                $websiteUri,
                $this->getStylesheetTag('css/vacancesdirectes/iframe.css', $app, $request),
                $javascriptHeader,
                $javascriptFooter,
                '',
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

    public function getAsset($url, $app, Request $request)
    {
        $asset = $app['twig']->getExtension('asset')->asset($url);
        return sprintf('%s://%s%s', $request->getScheme(), $request->getHttpHost(), $asset);
    }

    public function getStylesheetTag($url, $app, Request $request)
    {
        $asset = $app['twig']->getExtension('asset')->asset($url);
        return sprintf('<link rel="stylesheet" href="%s://%s%s">', $request->getScheme(), $request->getHttpHost(), $asset);
    }

    public function getJavscriptTag($url, $app, Request $request)
    {
        $asset = $app['twig']->getExtension('asset')->asset($url);
        return sprintf('<script type="text/javascript" src="%s://%s%s"></script>', $request->getScheme(), $request->getHttpHost(), $asset);
    }
}

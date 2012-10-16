<?php

namespace Resalys\Controller;

use Silex\Application,
    Silex\ControllerCollection,
    Silex\ControllerProviderInterface;

use Symfony\Component\HttpFoundation\Request,
    Symfony\Component\HttpKernel\Exception\NotFoundHttpException,
    Symfony\Component\HttpFoundation\Response,
    Symfony\Component\Routing\Route,
    Symfony\Component\Yaml\Yaml;

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
            $queryParameters = $request->query->all();
            $queryString     = $request->getQueryString();
            $websiteUri      = rtrim($app['url_generator']->generate('homepage', array(), true), '/');

            $clientConfigurationFilename = sprintf('%s/app/config/Resalys/client.yml', $app['config']->get('root_dir'));
            $clientConfiguration = Yaml::parse($clientConfigurationFilename);


            $iframe = file_get_contents(sprintf("%s?%s", $clientConfiguration['services']['modele']['location'], $queryString));
            $iframe = $this->replace($iframe);

            // define back button
            $backUri = '';
            if (!empty($queryParameters['from']))
            {
                switch ($queryParameters['from'])
                {
                    case 'package':
                        $backUri = 'achat/packages.html';
                        break;
                    case 'result':
                        $backUri = 'achat/resultats-recherche.html';
                        break;
                }
            }

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
                '{_c2is.back}',
                '{_c2is.uri.ficheCamping}',
                '<b><b>',
            ), array(
                $websiteUri,
                $this->getStylesheetTag('css/vacancesdirectes/iframe.css', $app, $request),
                $javascriptHeader,
                $javascriptFooter,
                $backUri,
                sprintf('%s/camping', $websiteUri),
                '',
            ), $iframe);

            return new Response($iframe);
        })
        ->bind('resalys_wrapper');

        return $controllers;
    }

    public function replace($iframe)
    {
        $matches = null;

        if (preg_match_all('"{_c2is.replace, \'(.*)\', \'(.*)\', \'(.*)\'}"', $iframe, $matches, PREG_SET_ORDER))
        {
            foreach ($matches as $match)
            {
                $newUri = str_replace($match[1], $match[2], $match[3]);
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

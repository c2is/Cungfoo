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
    protected
        $app,
        $request,
        $websiteUri
    ;

    /**
     * {@inheritdoc}
     */
    public function connect(Application $app)
    {
        // creates a new controller based on the default route
        $controllers = $app['controllers_factory'];

        $controllers->match('/wrapper', function (Request $request) use ($app)
        {
            // define default class attributes
            $this->app        = $app;
            $this->request   = $request;
            $this->websiteUri = rtrim($app['url_generator']->generate('homepage', array(), true), '/');

            // get content of resalys modele
            $clientConfigurationFilename = sprintf('%s/app/config/Resalys/client.yml', $app['config']->get('root_dir'));
            $clientConfiguration = Yaml::parse($clientConfigurationFilename);
            $iframe = file_get_contents(sprintf("%s?%s", $clientConfiguration['services']['modele']['location'], $this->request->getQueryString()));

            // start replace functions
            $this->replaceC2isMarker($iframe);
            $this->replaceSpecifics($iframe);

            return new Response($iframe);
        })
        ->bind('resalys_wrapper');

        return $controllers;
    }

    protected function getAsset($url)
    {
        $asset = $this->app['twig']->getExtension('asset')->asset($url);

        return sprintf('%s://%s%s',
            $this->request->getScheme(),
            $this->request->getHttpHost(),
            $asset
        );
    }

    protected function getStylesheetTag($url)
    {
        $asset = $this->app['twig']->getExtension('asset')->asset($url);

        return sprintf('<link rel="stylesheet" href="%s://%s%s">',
            $this->request->getScheme(),
            $this->request->getHttpHost(),
            $asset
        );
    }

    protected function getJavscriptTag($url)
    {
        $asset = $this->app['twig']->getExtension('asset')->asset($url);

        return sprintf('<script type="text/javascript" src="%s://%s%s"></script>',
            $this->request->getScheme(),
            $this->request->getHttpHost(),
            $asset
        );
    }

    protected function replaceC2isMarkerFunction(&$iframe)
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
    }

    protected function replaceC2isMarker(&$iframe)
    {
        $this->replaceC2isMarkerFunction($iframe);

            // define javascript header source code
        $javascriptHeader = sprintf(<<<eof
<script src="%s"></script>
<script>var templatePath = '%s';</script><!-- templatePath : chemin du template en absolue -->
eof
, $this->getAsset('vendor/head.extended.js')
, $this->getAsset('')
);

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
        ), array(
            $this->websiteUri,
            $this->getStylesheetTag('css/vacancesdirectes/iframe.css'),
            $javascriptHeader,
            $javascriptFooter,
        ), $iframe);
    }

    protected function replaceSpecifics(&$iframe)
    {
        $this->replaceDayNightByWeeks($iframe);
        $this->replaceBackButtonUri($iframe);
        $this->replaceWeekTimes($iframe);
        $this->replaceCampingFicheUri($iframe);

        $this->replaceString($iframe, 'Choisir', 'Réserver');
        $this->replaceString($iframe, '<b><b>');
        $this->replaceString($iframe, 'Vos séjours', 'Votre réservation');
    }

    protected function replaceDayNightByWeeks(&$iframe)
    {
        $dayNight = preg_match_all('"<div class=\"label\">([0-9]*) jours / ([0-9]*) nuits</div>"', $iframe, $matches, PREG_SET_ORDER);
        foreach ($matches as $match)
        {
            $weeks = (int)($match[1] / 7);
            $iframe = str_replace($match[0], sprintf('<div class="label">%s</div><div class="field">semaine%s</div>', $weeks, $weeks == 1 ? '' : 's'), $iframe);
        }

        $dayNight = preg_match_all('"<p class=\"proposalLength\">([0-9]*) jours / ([0-9]*) nuits</p>"', $iframe, $matches, PREG_SET_ORDER);
        foreach ($matches as $match)
        {
            $weeks = (int)($match[1] / 7);
            $iframe = str_replace($match[0], sprintf('<p class="proposalLength">%s semaine%s</p>', $weeks, $weeks == 1 ? '' : 's'), $iframe);
        }
    }

    protected function replaceBackButtonUri(&$iframe)
    {
        $queryParameters  = $this->request->query->all();

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

        $iframe = str_replace('{_c2is.back}', $backUri, $iframe);
    }

    protected function replaceWeekTimes(&$iframe)
    {
        $iframe = preg_replace("/(\d*) x /", "$1 semaines / ", $iframe);
        $iframe = preg_replace("/1 semaines /", "1 semaine ", $iframe);
    }

    protected function replaceCampingFicheUri(&$iframe)
    {
        $iframe = str_replace('{_c2is.uri.ficheCamping}', sprintf('%s/camping', $this->websiteUri), $iframe);
    }

    protected function replaceString(&$iframe, $search, $replace = '')
    {
        $iframe = str_replace($search, $replace, $iframe);
    }
}

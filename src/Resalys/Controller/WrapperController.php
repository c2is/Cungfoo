<?php

namespace Resalys\Controller;

use Silex\Application,
    Silex\ControllerCollection,
    Silex\ControllerProviderInterface;

use Symfony\Component\HttpFoundation\Request,
    Symfony\Component\HttpKernel\Exception\NotFoundHttpException,
    Symfony\Component\HttpFoundation\Response,
	Symfony\Component\HttpFoundation\Cookie,
    Symfony\Component\Routing\Route,
    Symfony\Component\Yaml\Yaml;

class WrapperController implements ControllerProviderInterface
{
    protected
        $app,
        $request,
        $websiteUri,
        $specificFiles
    ;

    /**
     * {@inheritdoc}
     */
    public function connect(Application $app)
    {
        // creates a new controller based on the default route
        $controllers = $app['controllers_factory'];

        $controllers->match('/wrapper/{specificFiles}', function (Request $request, $specificFiles) use ($app)
        {
			$response = new Response();

            // define default class attributes
            $this->app           = $app;
            $this->request       = $request;
            $this->websiteUri    = rtrim($app['url_generator']->generate('homepage', array(), true), '/');
            $this->specificFiles = $specificFiles;

            // get content of resalys modele
            $clientConfigurationFilename = sprintf('%s/app/config/Resalys/client.yml', $app['config']->get('root_dir'));
            $clientConfiguration = Yaml::parse($clientConfigurationFilename);

            // différencier le site ce du site indiv
            $location = $clientConfiguration['services']['modele']['location'];
            $location = str_replace($app['config']->get('languages')['fr']['domain'], $app['config']->get('languages')[$app['context']->getLanguage()]['domain'], $location);
            if ($app['context']->get('site') == "site.ce")
            {
                $location = str_replace("www.", "ce.", $location);
            }

            $resalysUri = sprintf("%s?%s&%s",
                $location,
                $this->request->getQueryString(),
                http_build_query($this->request->request->all())
            );

            $http_response_header = array();

			$iframe = file_get_contents($resalysUri);

			// start replace functions
            $this->replaceC2isLabelFunction($iframe, $app);
            $this->replaceC2isMarker($iframe, $app);
            $this->replaceSpecifics($iframe);

			$response->setContent($iframe);

			$response->headers->set('Cache-Control', sprintf('s-maxage=%s, public', $request->get('maxAge', 0)));
			$date = new \DateTime();
			$sansCache = array('couloir', 'compte');
			if(in_array($this->specificFiles,$sansCache)) $response->setExpires($date);

			foreach ($http_response_header as $resalysHeader) {
				if (strpos($resalysHeader, 'AP-RSL-Front') !== false) {
                    $response->headers->set('AP-RSL-Front',str_replace('AP-RSL-Front: ', '', $resalysHeader));
                }
				
				if (strpos($resalysHeader, 'Set-Cookie') !== false 
				 && strpos($resalysHeader, 'X-Cacheable: NO: Server Set-Cookie')) {
					$arrayHeaderCoookie = explode('; ',trim(str_replace('Set-Cookie: ', '', $resalysHeader)));
					foreach($arrayHeaderCoookie as $keyHeaderCoookie => $valueHeaderCoookie) {
						$tmpArray = explode('=',$valueHeaderCoookie,2);
						if( $tmpArray[0] == 'Domain' || $tmpArray[0] == 'Path' ) {
							$arrayHeaderCoookie[ $tmpArray[0] ] = $tmpArray[1];
						}
						else {
							$arrayHeaderCoookie['name'] = $tmpArray[0];
							$arrayHeaderCoookie['value'] = $tmpArray[1];
						}
						unset($arrayHeaderCoookie[$keyHeaderCoookie]);
					}
					
					$response->headers->setCookie( new Cookie(
						$arrayHeaderCoookie['name'], 
						$arrayHeaderCoookie['value'], 
						0, // expire (session)
						$arrayHeaderCoookie['Path'],

						$arrayHeaderCoookie['Domain'],
						false, // secure
						false  // httponly

					));	
                }
            }

			return $response;
        })
        ->value('specificFiles', 'iframe')
        ->bind('resalys_wrapper');

        return $controllers;
    }

    protected function getAsset($url, $absolute = true)
    {
        $asset = $this->app['twig']->getExtension('asset')->asset($url);

        if (!$absolute) {
            $currentUrl = rtrim($this->app->url('homepage'), '/');
            $currentUrlExploded = explode('/', $currentUrl);

            unset($currentUrlExploded[count($currentUrlExploded) -1]);

            $domain = implode('/', $currentUrlExploded);

            $request = $this->app['request'];
            $domain = $request->getScheme() . '://' . $request->getHttpHost();
            return $domain . '/' . ltrim($url, '/');
        }

        if ($this->app['config']->settings['assets_base_url']) {
            return str_replace('http://', sprintf("%s://", $this->request->getScheme()), $asset);
        }

        return sprintf('%s://%s%s',
            $this->request->getScheme(),
            $this->request->getHttpHost(),
            $asset
        );
    }

    protected function getStylesheetTag($url, $condition = null, $cdn = true)
    {
        $asset = $this->getAsset($url, $cdn);

        $output = sprintf('<link rel="stylesheet" href="%s?v=%s">',
            $asset,
            $this->app['config']->get('version')
        );

        if ($condition !== null)
        {
            if ($cdn) {
                $conditionString = "<!--[if %s]><!-->%s<!--<![endif]-->";
            }
            else {
                $conditionString = "<!--[if %s]>%s<![endif]-->";
            }

            $output = sprintf($conditionString, $condition, $output);
        }

        return $output;
    }

    protected function getStylesheetPrintTag($url)
    {
        $asset = $this->getAsset($url);

        return sprintf('<link rel="stylesheet" href="%s?v=%s" media="print">',
            $asset,
            $this->app['config']->get('version')
        );
    }

    protected function getStylesheetDatepickerTag($url)
    {
        $asset = $this->getAsset($url);

        return sprintf('<link rel="stylesheet" href="%s?v=%s" media="screen">',
            $asset,
            $this->app['config']->get('version')
        );
    }

    protected function getJavscriptTag($url)
    {
        $asset = $this->getAsset($url);

        return sprintf('<script type="text/javascript" src="%s?v="></script>',
            $asset,
            $this->app['config']->get('version')
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

    protected function replaceC2isLabelFunction(&$iframe, $app)
    {
        $matches = null;

        if (preg_match_all('"{_c2is.label, \'(.*?)\'}"', $iframe, $matches, PREG_SET_ORDER))
        {
            foreach ($matches as $match)
            {
                $iframe = str_replace($match[0], $app['translator']->trans($match[1]), $iframe);
            }
        }
    }

    protected function replaceC2isMarker(&$iframe, $app)
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

        $locale = $app['context']->get('language');
            // define javascript footer source code
        $javascriptFooter = sprintf(<<<eof

    <script src="http://code.jquery.com/jquery-1.8.0.min.js"></script>

    <script>
        var version = '%s';

        head.js(
            {modernizr: templatePath+"vendor/modernizr-2.6.1.min.js?v=" + version}, // test support html5 functionality
            {selectivizr: templatePath+"vendor/selectivizr-min.js?v=" + version}, // extend css selectors for IE
            {jqPlugins: templatePath+"js/vacancesdirectes/plugins.js?v=" + version},
            {datepicker: templatePath+"js/vacancesdirectes/jquery-ui-1.9.2.custom.min.js?v=" + version},
            {i18nDatepicker: templatePath+"js/vacancesdirectes/jquery.ui.datepicker-$locale.js?v=" + version},
            {iframeJS: templatePath+"js/vacancesdirectes/%s.js?v=" + version}
        );
    </script>

    <!-- Prompt IE 6/7 users to install Chrome Frame -->
    <!--[if lt IE 8 ]>
    <script src="//ajax.googleapis.com/ajax/libs/chrome-frame/1.0.3/CFInstall.min.js"></script>
    <script>window.attachEvent('onload',function(){CFInstall.check({mode:'overlay'})})</script>
    <![endif]-->
eof
            , $app['config']->get('version')
            , $this->specificFiles);

        $iframe = str_replace(array(
            '{_c2is.uri}',
            '{_c2is.stylesheet}',
            '{_c2is.stylesheet_print}',
            '{_c2is.stylesheet_datepicker}',
            '{_c2is.javascript.header}',
            '{_c2is.javascript.footer}',
        ), array(
            $this->websiteUri,
            $this->getStylesheetTag(sprintf('css/vacancesdirectes/%s.css', $this->specificFiles), "gte IE 9").
            $this->getStylesheetTag(sprintf('css/vacancesdirectes/%s.css', $this->specificFiles), "lt IE 9", false).
            $this->getStylesheetTag('css/vacancesdirectes/ie.css', "lt IE 9", false),
            $this->getStylesheetPrintTag('css/vacancesdirectes/print.css'),
            $this->getStylesheetDatepickerTag('css/vacancesdirectes/vd-theme/jquery-ui-1.9.2.custom.min.css'),
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

        $resalysParameters = array('specificFiles' => $this->specificFiles);
        $this->replaceString($iframe, '\'\/rsl\/clickbooking\'', "'" . $this->app['url_generator']->generate('resalys_wrapper', $resalysParameters, true) . "'");
        $this->replaceString($iframe, '"/rsl/clickbooking', '"' . $this->app['url_generator']->generate('resalys_wrapper', $resalysParameters, true));

        if ($this->specificFiles == "couloir")
        {
            $this->replaceString($iframe, '{_c2is.proposalKey}', $this->request->get('proposal_key'));
        }

        $this->replaceString($iframe, 'Choisir', 'Réserver');
        $this->replaceString($iframe, '<b><b>');
        $this->replaceString($iframe, 'Vos séjours', 'Votre réservation');
        $this->replaceString($iframe, '.00', '');
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
        $iframe = preg_replace("/1 semaines \//", "", $iframe);
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

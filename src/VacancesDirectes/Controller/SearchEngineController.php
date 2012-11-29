<?php

namespace VacancesDirectes\Controller;

use Silex\Application,
    Silex\ControllerCollection,
    Silex\ControllerProviderInterface;

use Symfony\Component\HttpFoundation\Request,
    Symfony\Component\HttpKernel\Exception\NotFoundHttpException,
    Symfony\Component\Routing\Route,
    Symfony\Component\HttpFoundation\Response;

use Cungfoo\Model;

use VacancesDirectes\Lib\SearchEngine;

use VacancesDirectes\Form\Type\Search\DateType,
    VacancesDirectes\Form\Data\Search\DateData;

class SearchEngineController implements ControllerProviderInterface
{
    /**
     * {@inheritdoc}
     */
    public function connect(Application $app)
    {
        $controllers = $app['controllers_factory'];

        $controllers->match('/destinations/getVilles', function (Request $request) use ($app)
        {
            $code = $request->get('code');

            $region = Model\RegionQuery::create()
                ->filterByCode($code)
                ->findOne()
            ;

            $villes = Model\VilleQuery::create()
                ->joinWithI18n($app['context']->get('language'))
                ->withColumn('VilleI18n.name', 'name')
                ->select(array('code', 'name'))
                ->filterByDestination($region, $code)
                ->orderBy('name')
                ->findActive()
            ;

            $response = new Response(json_encode($villes, true));
            $response->headers->set('Content-Type', 'application/json');

            return $response;
        })
        ->bind('search_engine_get_villes_by_destination');

        $controllers->match('/destinations/getCampings', function (Request $request) use ($app)
        {
            $code = $request->get('code');

            $region = Model\RegionQuery::create()
                ->filterByCode($code)
                ->findOne()
            ;

            $campings = Model\EtablissementQuery::create()
                ->select(array('code', 'name'))
                ->filterByDestination($region, $code)
                ->orderByName()
                ->findActive()
            ;

            $response = new Response(json_encode($campings, true));
            $response->headers->set('Content-Type', 'application/json');

            return $response;
        })
        ->bind('search_engine_get_campings_by_destination');

        return $controllers;
    }
}

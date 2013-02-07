<?php

namespace VacancesDirectesCe\Controller;

use Silex\Application,
    Silex\ControllerCollection,
    Silex\ControllerProviderInterface;

use Symfony\Component\HttpFoundation\Request,
    Symfony\Component\HttpKernel\Exception\NotFoundHttpException,
    Symfony\Component\HttpFoundation\Response,
    Symfony\Component\Routing\Route;

use Cungfoo\Model\RegionQuery,
    Cungfoo\Model\EtablissementQuery;

class SearchController implements ControllerProviderInterface
{
    /**
     * {@inheritdoc}
     */
    public function connect(Application $app)
    {
        // creates a new controller based on the default route
        $controllers = $app['controllers_factory'];

        $controllers->match('/search_get_regions_by_pays.html', function (Request $request) use ($app)
        {
            $code = $request->query->all()['code'];

            $regions = RegionQuery::create()
                ->_if($code)
                ->usePaysQuery()
                    ->filterByCode($code)
                ->endUse()
                ->_endif()
                ->useI18nQuery('fr', 'region_i18n')
                    ->withColumn('region_i18n.Name', 'name')
                    ->orderByName()
                ->endUse()
                ->select(array('code', 'name'))
                ->findActive()
                ->toArray()
            ;

            return new Response(json_encode($regions), 200, array(
                'Content-Type' => 'application/json',
            ));
        })->bind('search_get_regions_by_pays');

        $controllers->match('/search_get_campings_by_pays.html', function (Request $request) use ($app)
        {
            $code = $request->query->all()['code'];

            $campings = EtablissementQuery::create()
                ->_if($code)
                ->useVilleQuery()
                    ->useRegionQuery()
                        ->usePaysQuery()
                            ->filterByCode($code)
                        ->endUse()
                    ->endUse()
                ->endUse()
                ->_endif()
                ->select(array('code','name'))
                ->orderByName()
                ->findActive()
                ->toArray()
            ;

            return new Response(json_encode($campings), 200, array(
                'Content-Type' => 'application/json',
            ));
        })->bind('search_get_campings_by_pays');

        $controllers->match('/search_get_campings_by_region.html', function (Request $request) use ($app)
        {
            $code = $request->query->all()['code'];

            $campings = EtablissementQuery::create()
                ->_if($code)
                ->useVilleQuery()
                    ->useRegionQuery()
                        ->filterByCode($code)
                    ->endUse()
                ->endUse()
                ->_endif()
                ->select(array('code','name'))
                ->orderByName()
                ->findActive()
                ->toArray()
            ;

            return new Response(json_encode($campings), 200, array(
                'Content-Type' => 'application/json',
            ));
        })->bind('search_get_campings_by_region');

        return $controllers;
    }
}

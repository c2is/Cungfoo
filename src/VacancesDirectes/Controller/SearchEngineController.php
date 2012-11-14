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

        $controllers->match('/', function (Request $request) use ($app)
        {
            /** Search form date */
            $searchDateData = new DateData();
            $searchDateForm = $app['form.factory']->create(new DateType($app), $searchDateData);
            if ('POST' == $request->getMethod())
            {
                /** Manage search form date validation */
                $searchDateForm->bind($request->get($searchDateForm->getName()));
                if ($searchDateForm->isValid())
                {
                    return $app->redirect($app['url_generator']->generate('catalogue', array(
                        'large' => $searchDateData->destination,
                        'small' => $searchDateData->isCamping ? $searchDateData->camping : $searchDateData->ville
                    )));
                }
            }

            return $app['twig']->render('Form/search_engine.twig', array(
                'searchDateForm' => $searchDateForm->createView(),
            ));
        })
        ->bind('search_engine');

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
                ->_if($code)
                    ->useRegionQuery()
                        ->_if($region)
                            ->filterByCode($code)
                        ->_else()
                            ->usePaysQuery()
                                ->filterByCode($code)
                            ->endUse()
                        ->_endif()
                    ->endUse()
                ->_endif()
                ->orderBy('name')
                ->find()
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
                ->_if($code)
                ->useVilleQuery()
                    ->useRegionQuery()
                    ->_if($region)
                        ->filterByCode($code)
                    ->_else()
                        ->usePaysQuery()
                            ->filterByCode($code)
                        ->endUse()
                    ->_endif()
                    ->endUse()
                ->endUse()
                ->_endif()
                ->orderByName()
                ->find()
            ;

            $response = new Response(json_encode($campings, true));
            $response->headers->set('Content-Type', 'application/json');

            return $response;
        })
        ->bind('search_engine_get_campings_by_destination');

        return $controllers;
    }
}

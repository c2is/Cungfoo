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

        $controllers->get('/', function (Request $request) use ($app)
        {
            /** Search form date */
            $formData = new DateData();
            $dateSearchForm = $app['form.factory']->create(new DateType($app), $formData);
            if ('POST' == $request->getMethod())
            {
                /** Manage search form date validation */
                $dateSearchForm->bind($request->get($dateSearchForm->getName()));
                if ($dateSearchForm->isValid())
                {

                }
            }

            return $app['twig']->render('Form/search_engine.twig', array(
                'dateSearchForm'    => $dateSearchForm->createView(),
            ));
        })
        ->bind('search_engine');

        $controllers->match('/destinations/{id}/villes', function ($id) use ($app)
        {

            $villes = Model\VilleQuery::create()
                ->joinWithI18n($app['context']->get('language'))
                ->select(array('id', 'name'))
                ->withColumn('VilleI18n.name', 'name')
                ->filterByRegionId($id)
                ->find()
            ;

            $response = new Response(json_encode($villes, true));
            $response->headers->set('Content-Type', 'application/json');

            return $response;
        })
        ->bind('search_engine_date_villes_by_destination');

        $controllers->match('/destinations/{id}/campings', function ($id) use ($app)
        {

            $campings = Model\EtablissementQuery::create()
                ->select(array('id', 'name'))
                ->useVilleQuery()
                    ->filterByRegionId($id)
                ->endUse()
                ->find()
            ;

            $response = new Response(json_encode($campings, true));
            $response->headers->set('Content-Type', 'application/json');

            return $response;
        })
        ->bind('search_engine_date_campings_by_destination');

        return $controllers;
    }
}

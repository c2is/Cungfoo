<?php

namespace VacancesDirectes\Controller;

use Silex\Application,
    Silex\ControllerProviderInterface;

use Symfony\Component\HttpFoundation\Request,
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
                ->useEtablissementQuery()
                    ->filterByActive(true)
                ->endUse()
                ->setDistinct()
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
                ->filterByDestinationSearch($region, $code)
                ->orderByName()
                ->findActive()
            ;

            $response = new Response(json_encode($campings, true));
            $response->headers->set('Content-Type', 'application/json');

            return $response;
        })
        ->bind('search_engine_get_campings_by_destination');

        $controllers->post('/validate', function(Request $request) use ($app) {
            $searchDateData = new DateData();

            $searchDateQuery = $request->get('SearchDate');

            $searchDateData->destination = $searchDateQuery['destination'];
            $searchDateData->ville       = $searchDateQuery['ville'];
            $searchDateData->camping     = $searchDateQuery['camping'];
            $searchDateData->isCamping   = $searchDateQuery['isCamping'];

            $form = $app['form.factory']->create(new DateType($app), $searchDateData);
            $form->bind($request);

            $success    = false;
            $errors     = array();
            if ($form->isValid()) {
                $success = true;
            } else {
                foreach ($form->getErrors() as $error) {
                    $template = $error->getMessageTemplate();
                    $parameters = $error->getMessageParameters();

                    foreach($parameters as $var => $value){
                        $template = str_replace($var, $value, $template);
                    }

                    $key = str_replace('date_search.', '', $template);
                    $key = substr($key, 0, strpos($key, '.'));
                    $errors[$key] = $app->trans($template);
                }
            }

            return json_encode(array(
                $form->getName() => array(
                    'success'   => $success,
                    'errors'    => $errors,
                )
            ));
        })
        ->bind('search_engine_validate');

        return $controllers;
    }
}

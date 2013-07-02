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

use VacancesDirectes\Lib\SearchEngine,
    VacancesDirectes\Form\Type\Search\DateType,
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

            $form = $this->app['form.factory']->create(new DateType($this->app), $searchDateData);
            $form->bind($request);

            $success    = false;
            $errors     = array();
            if ($form->isValid()) {
                $success = true;
            } else {
                foreach ($form->getErrors() as $key => $error) {
                    $template = $error->getMessageTemplate();
                    $parameters = $error->getMessageParameters();

                    foreach($parameters as $var => $value){
                        $template = str_replace($var, $value, $template);
                    }

                    $errors[$key] = $template;
                }
            }

            return json_encode(array(
                'success'   => $success,
                'errors'    => $errors,
            ));
        });

        return $controllers;
    }
}

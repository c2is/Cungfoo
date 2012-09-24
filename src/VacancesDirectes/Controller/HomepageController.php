<?php

namespace VacancesDirectes\Controller;

use Silex\Application,
    Silex\ControllerCollection,
    Silex\ControllerProviderInterface;

use Symfony\Component\HttpFoundation\Request,
    Symfony\Component\HttpKernel\Exception\NotFoundHttpException,
    Symfony\Component\Routing\Route;

use Cungfoo\Lib\GeographicCoordinates;

use VacancesDirectes\Form\Type\Search\DateType,
    VacancesDirectes\Form\Data\Search\DateData,
    VacancesDirectes\Form\Type\Search\GeoPositionType;

class HomepageController implements ControllerProviderInterface
{
    /**
     * {@inheritdoc}
     */
    public function connect(Application $app)
    {
        // creates a new controller based on the default route
        $controllers = $app['controllers_factory'];

        $controllers->match('/', function (Request $request) use ($app)
        {
            $locale = $app['context']->get('language');

            /** @var \Cungfoo\Model\Etablissement $etablissement  */
            $etablissement = \Cungfoo\Model\EtablissementQuery::create()
                ->joinWithI18n($locale)
                ->findOne()
            ;

            /** Search form date */
            $formDateData = new DateData();
            $dateSearchForm = $app['form.factory']->create(new DateType($app), $formDateData);
            if ('POST' == $request->getMethod())
            {
                /** Manage search form date validation */
                $dateSearchForm->bind($request->get($dateSearchForm->getName()));
                if ($dateSearchForm->isValid())
                {

                }
            }

            /** Search form temps trajet */
            $tempsTrajetSearchForm = $app['form.factory']->create(new GeoPositionType($app));
            if ('POST' == $request->getMethod())
            {
                /** Manage search form date validation */
                $tempsTrajetSearchForm->bind($request->get($tempsTrajetSearchForm->getName()));
                if ($tempsTrajetSearchForm->isValid())
                {
                    return $app->redirect($app['url_generator']->generate('search_engine_by_temps_trajet', $tempsTrajetSearchForm->getData()));
                }
            }

            return $app['twig']->render('etablissement.twig', array(
                'dateSearchForm'        => $dateSearchForm->createView(),
                'tempsTrajetSearchForm' => $tempsTrajetSearchForm->createView(),
                'etablissement'         => $etablissement,
                'locale'                => $locale,
            ));
        })
        ->bind('homepage');

        return $controllers;
    }
}

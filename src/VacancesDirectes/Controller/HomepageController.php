<?php

namespace VacancesDirectes\Controller;

use Silex\Application,
    Silex\ControllerCollection,
    Silex\ControllerProviderInterface;

use Symfony\Component\HttpFoundation\Request,
    Symfony\Component\HttpKernel\Exception\NotFoundHttpException,
    Symfony\Component\Routing\Route;


use VacancesDirectes\Form\Type\Search\DateType,
    VacancesDirectes\Form\Data\Search\DateData;

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
            var_dump($app['memcache']->get('data1', function() use($app) { 
                return "toto";
            }));
            var_dump($app['memcache']->get('data1'));
            var_dump($app['memcache']->set('data1', 256));
            var_dump($app['memcache']->get('data1'));
            //$app['memcache']->delete('data1');
            var_dump($app['memcache']->get('data1'));

            // $app['memcache']->set('data1', array('some' => 'data')));
            // $app['memcache']->delete('some.data');


            die('in');

            $locale = $app['context']->get('language');

            /** @var \Cungfoo\Model\Etablissement $etablissement  */
            $etablissement = \Cungfoo\Model\EtablissementQuery::create()
                ->joinWithI18n($locale)
                ->findOne()
            ;

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

            return $app['twig']->render('etablissement.twig', array(
                'dateSearchForm'    => $dateSearchForm->createView(),
                'etablissement'     => $etablissement,
                'locale'            => $locale
            ));
        })
        ->bind('homepage');

        return $controllers;
    }
}

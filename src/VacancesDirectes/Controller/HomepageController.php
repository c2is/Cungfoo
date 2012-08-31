<?php

namespace VacancesDirectes\Controller;

use Silex\Application,
Silex\ControllerCollection,
Silex\ControllerProviderInterface;

use Symfony\Component\HttpFoundation\Request,
Symfony\Component\HttpKernel\Exception\NotFoundHttpException,
Symfony\Component\Routing\Route;

class HomepageController implements ControllerProviderInterface
{
    /**
     * {@inheritdoc}
     */
    public function connect(Application $app)
    {
        // creates a new controller based on the default route
        $controllers = $app['controllers_factory'];

        $controllers->get('/', function () use ($app)
        {
            $locale = $app['context']->get('language');

            /** @var \Cungfoo\Model\Etablissement $etablissement  */
            $etablissement = \Cungfoo\Model\EtablissementQuery::create()
                ->joinWithI18n($locale)
                ->findOne()
            ;

            return $app['twig']->render('VacancesDirectes/etablissement.twig', array(
                'etablissement' => $etablissement,
                'locale'        => $locale
            ));
        })
        ->bind('homepage');

        return $controllers;
    }
}

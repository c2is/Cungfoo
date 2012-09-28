<?php

namespace VacancesDirectes\Controller;

use Silex\Application,
    Silex\ControllerCollection,
    Silex\ControllerProviderInterface;

use Symfony\Component\HttpFoundation\Request;

class CampingController implements ControllerProviderInterface
{
    /**
     * {@inheritdoc}
     */
    public function connect(Application $app)
    {
        $controllers = $app['controllers_factory'];

        $controllers->match('/{id}', function ($id) use ($app)
        {
            $locale = $app['context']->get('language');

            /** @var \Cungfoo\Model\Etablissement $etablissement  */
            $etablissement = \Cungfoo\Model\EtablissementQuery::create()
                ->joinWithI18n($locale)
                ->filterById($id)
                ->findOne()
            ;

            return $app['twig']->render('etablissement.twig', array(
                'etablissement'     => $etablissement,
                'locale'            => $locale
            ));
        })
        ->bind('camping')
        ;

        return $controllers;
    }
}

<?php

namespace VacancesDirectes\Controller;

use Silex\Application,
    Silex\ControllerCollection,
    Silex\ControllerProviderInterface;

class DestinationVilleController implements ControllerProviderInterface
{
    /**
     * {@inheritdoc}
     */
    public function connect(Application $app)
    {
        $controllers = $app['controllers_factory'];

        $controllers->match('/{villeSlug}', function ($villeSlug) use ($app)
        {
            $locale = $app['context']->get('language');

            return $app['twig']->render('Destination/ville.twig', array(
                'locale' => $locale,
            ));
        })
        ->bind('destination-ville');

        return $controllers;
    }
}

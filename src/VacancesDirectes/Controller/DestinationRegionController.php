<?php

namespace VacancesDirectes\Controller;

use Silex\Application,
    Silex\ControllerCollection,
    Silex\ControllerProviderInterface;

class DestinationRegionController implements ControllerProviderInterface
{
    /**
     * {@inheritdoc}
     */
    public function connect(Application $app)
    {
        $controllers = $app['controllers_factory'];

        $controllers->match('/{regionSlug}', function ($regionSlug) use ($app)
        {
            $locale = $app['context']->get('language');

            return $app['twig']->render('Destination/region.twig', array(
                'locale' => $locale,
            ));
        })
        ->bind('destination-region');

        return $controllers;
    }
}

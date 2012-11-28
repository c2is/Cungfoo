<?php

namespace VacancesDirectes\Controller;

use Silex\Application,
    Silex\ControllerCollection,
    Silex\ControllerProviderInterface;

class DestinationPaysController implements ControllerProviderInterface
{
    /**
     * {@inheritdoc}
     */
    public function connect(Application $app)
    {
        $controllers = $app['controllers_factory'];

        $controllers->match('/{codeResalys}', function ($codeResalys) use ($app)
        {
            $locale = $app['context']->get('language');

            return $app['twig']->render('Destination/detail.twig', array(
                'locale' => $locale,
            ));
        })
        ->bind('destination_pays');

        return $controllers;
    }
}

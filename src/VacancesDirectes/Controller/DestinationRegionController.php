<?php

namespace VacancesDirectes\Controller;

use Cungfoo\Model\RegionQuery,
    Cungfoo\Model\PointInteretPeer,
    Cungfoo\Model\EventPeer;

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

        $controllers->match('/{codeResalys}', function ($codeResalys) use ($app)
        {
            $locale = $app['context']->get('language');

            $region = RegionQuery::create()
                ->joinWithI18n($locale)
                ->filterByCode($codeResalys)
                ->findOne()
            ;

            $sitesAVisiter = PointInteretPeer::getForRegion($region, PointInteretPeer::RANDOM_SORT, 5);
            $events        = EventPeer::getForRegion($region, EventPeer::RANDOM_SORT, 5);

            return $app['twig']->render('Destination/region.twig', array(
                'locale'        => $locale,
                'region'          => $region,
                'sitesAVisiter' => $sitesAVisiter,
                'events'        => $events,
            ));
        })
        ->bind('destination_region');

        return $controllers;
    }
}

<?php

namespace VacancesDirectes\Controller;

use Symfony\Component\HttpFoundation\Request;

use Silex\Application,
    Silex\ControllerCollection,
    Silex\ControllerProviderInterface;

use Cungfoo\Model\Pays,
    Cungfoo\Model\PaysQuery,
    Cungfoo\Model\Region,
    Cungfoo\Model\RegionQuery,
    Cungfoo\Model\PointInteretPeer,
    Cungfoo\Model\EventPeer,
    Cungfoo\Model\EtablissementPeer;

use VacancesDirectes\Lib\Listing\CatalogueListing,
    VacancesDirectes\Lib\SearchEngine;

class DestinationRegionController implements ControllerProviderInterface
{
    /**
     * {@inheritdoc}
     */
    public function connect(Application $app)
    {
        $controllers = $app['controllers_factory'];

        $controllers->convert('pays', function($pays) use ($app)
        {
            $locale = $app['context']->get('language');

            $paysObject = PaysQuery::create()
                ->joinWithI18n($locale)
                ->usePaysI18nQuery()
                    ->filterBySlug($pays)
                ->endUse()
                ->findOne()
            ;

            if (!$paysObject)
            {
                $app->abort(404, "$pays does not exist.");
            }

            return $paysObject;
        });

        $controllers->convert('region', function($region) use ($app)
        {
            $locale = $app['context']->get('language');

            $regionObject = RegionQuery::create()
                ->joinWithI18n($locale)
                ->useRegionI18nQuery()
                    ->filterBySlug($region)
                ->endUse()
                ->findOne()
            ;

            if (!$regionObject)
            {
                $app->abort(404, "$region does not exist.");
            }

            return $regionObject;
        });

        $controllers->match('/', function (Request $request, Pays $pays, Region $region) use ($app)
        {
            $locale = $app['context']->get('language');

            // Formulaire de recherche
            $searchEngine = new SearchEngine($app, $request);
            $searchEngine->process();
            if ($searchEngine->getRedirect())
            {
                return $app->redirect($searchEngine->getRedirect());
            }

            $sitesAVisiter      = PointInteretPeer::getForRegion($region, PointInteretPeer::RANDOM_SORT, 5);
            $nbSitesAVisiter    = PointInteretPeer::getCountForRegion($region);
            $events             = EventPeer::getForRegion($region, EventPeer::SORT_BY_PRIORITY, 5);
            $campings           = EtablissementPeer::getForRegion($region, EtablissementPeer::RANDOM_SORT);

            $nbCampinsg = count($campings);
            $listData = array();
            for($i = 0; $i < 5 && $i < $nbCampinsg; $i++)
            {
                $listData[] = $campings[$i];
            }

            $list = new CatalogueListing($app);
            $list
                ->setData($listData)
                ->setType(CatalogueListing::CATALOGUE)
            ;
            $listContent = $list->process();

            return $app['twig']->render('Destination/detail.twig', array(
                'locale'            => $locale,
                'item'              => $region,
                'sitesAVisiter'     => $sitesAVisiter,
                'nbSitesAVisiter'   => $nbSitesAVisiter,
                'events'            => $events,
                'campings'          => $campings,
                'list'              => $listContent,
                'firstEtab'         => reset($listContent['element']),
                'searchForm'        => $searchEngine->getView(),
                'imagesTitle'       => $app['translator']->trans('destination.images_region_title'),
            ));
        })
        ->bind('destination_region');

        return $controllers;
    }
}

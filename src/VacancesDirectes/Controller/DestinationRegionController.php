<?php

namespace VacancesDirectes\Controller;

use Symfony\Component\HttpFoundation\Request;

use Silex\Application,
    Silex\ControllerCollection,
    Silex\ControllerProviderInterface;

use Cungfoo\Model\RegionQuery,
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

        $controllers->match('/{codeResalys}', function (Request $request, $codeResalys) use ($app)
        {
            $locale = $app['context']->get('language');

            // Formulaire de recherche
            $searchEngine = new SearchEngine($app, $request);
            $searchEngine->process();
            if ($searchEngine->getRedirect())
            {
                return $app->redirect($searchEngine->getRedirect());
            }

            $region = RegionQuery::create()
                ->joinWithI18n($locale)
                ->filterByCode($codeResalys)
                ->findOne()
            ;

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

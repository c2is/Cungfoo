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
    Cungfoo\Model\Ville,
    Cungfoo\Model\VilleQuery,
    Cungfoo\Model\Etablissement,
    Cungfoo\Model\EtablissementQuery,
    Cungfoo\Model\PointInteretPeer,
    Cungfoo\Model\EventPeer,
    Cungfoo\Model\EtablissementPeer;

use VacancesDirectes\Lib\Listing\CatalogueListing,
    VacancesDirectes\Lib\SearchEngine;

class DestinationController implements ControllerProviderInterface
{
    const DESTINATION_PAYS   = 'Pays';
    const DESTINATION_REGION = 'Region';
    const DESTINATION_VILLE  = 'Ville';

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
            if (!$region)
            {
                return;
            }

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

        $controllers->convert('ville', function($ville) use ($app)
        {
            if (!$ville)
            {
                return;
            }

            $locale = $app['context']->get('language');

            $villeObject = villeQuery::create()
                ->joinWithI18n($locale)
                ->useVilleI18nQuery()
                    ->filterBySlug($ville)
                ->endUse()
                ->findOne()
            ;

            if (!$villeObject)
            {
                $app->abort(404, "$ville does not exist.");
            }

            return $villeObject;
        });

        $controllers->convert('camping', function($camping) use ($app)
        {
            if (!$camping)
            {
                return;
            }

            $locale = $app['context']->get('language');

            $campingObject = EtablissementQuery::create()
                ->joinWithI18n($locale)
                ->filterBySlug($camping)
                ->findOne()
            ;

            if (!$campingObject)
            {
                $app->abort(404, "$camping does not exist.");
            }

            return $campingObject;
        });

        $controllers->match('/', function (Request $request, Pays $pays) use ($app)
        {
            return $this->process($app, $request, $pays, null, null, self::DESTINATION_PAYS);
        })
        ->bind('destination_pays');

        $controllers->match('/{region}/', function (Request $request, Pays $pays, Region $region) use ($app)
        {
            return $this->process($app, $request, $pays, $region, null, self::DESTINATION_REGION);
        })
        ->bind('destination_region');

        $controllers->match('/{region}/{ville}/', function (Request $request, Pays $pays, Region $region, Ville $ville) use ($app)
        {
            return $this->process($app, $request, $pays, $region, $ville, self::DESTINATION_VILLE);
        })
        ->bind('destination_ville');

        $controllers->match('/{region}/{ville}/{camping}.html', function (Request $request, Pays $pays, Region $region, Ville $ville, Etablissement $camping) use ($app)
        {
            return $this->processEtablissement($app, $request, $camping);
        })
        ->bind('destination_camping');

        return $controllers;
    }

    protected function process(Application $app, Request $request, $pays, $region = null, $ville = null, $destination = self::DESTINATION_PAYS)
    {
        $dateData = new \VacancesDirectes\Form\Data\Search\DateData();
        switch ($destination) {
            case self::DESTINATION_PAYS:
                $item = $pays;
                break;

            case self::DESTINATION_REGION:
                $item = $region;
                $dateData->destination = $region->getCode();
                break;

            case self::DESTINATION_VILLE:
                $item = $ville;
                $dateData->destination = $region->getCode();
                $dateData->ville = $ville->getCode();
                break;

            default:
                $app->abort(404, "This route does not exist.");
                break;
        }

        $locale = $app['context']->get('language');

        // Formulaire de recherche
        $searchEngine = new SearchEngine($app, $request);
        $searchEngine->process($dateData);

        if ($searchEngine->getRedirect())
        {
            return $app->redirect($searchEngine->getRedirect());
        }

        $getForMethod      = sprintf("getFor%s", $destination);
        $getCountForMethod = sprintf("getCountFor%s", $destination);

        $sitesAVisiter      = PointInteretPeer::$getForMethod($item, PointInteretPeer::RANDOM_SORT, 5);
        $nbSitesAVisiter    = PointInteretPeer::$getCountForMethod($item);
        $events             = EventPeer::$getForMethod($item, EventPeer::SORT_BY_PRIORITY, 9);
        $campings           = EtablissementPeer::$getForMethod($item, EtablissementPeer::RANDOM_SORT);

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

        return $app->renderView('Destination/detail.twig', array(
            'locale'            => $locale,
            'destination'       => $destination,
            'item'              => $item,
            'sitesAVisiter'     => $sitesAVisiter,
            'nbSitesAVisiter'   => $nbSitesAVisiter,
            'events'            => $events,
            'campings'          => $campings,
            'list'              => $listContent,
            'firstEtab'         => reset($listContent['element']),
            'searchForm'        => $searchEngine->getView(),
            'imagesTitle'       => $app->trans('destination.images_region_title'),
        ));
    }

    protected function processEtablissement(Application $app, Request $request, $camping)
    {
        $locale = $app['context']->get('language');

        $sitesAVisiter = PointInteretPeer::getForEtablissement($camping, PointInteretPeer::RANDOM_SORT, 4);
        $events        = EventPeer::getForEtablissement($camping, EventPeer::RANDOM_SORT, 4);

        $personnages = \Cungfoo\Model\PersonnageQuery::create()
            ->joinWithI18n($locale)
            ->filterByEtablissementId($camping->getId())
            ->orderByAge(\Criteria::ASC)
            ->limit(3)
            ->findActive()
        ;

        $multimedia = \Cungfoo\Model\MultimediaEtablissementQuery::create()
            ->joinWithI18n($locale)
            ->filterByEtablissementId($camping->getId())
            ->findActive()
        ;

        $tags = array();
        foreach($multimedia as $multi){
            $tag = explode(" ", $multi->getTagsForDisplay());
            foreach ($tag as $t) {
                if(!in_array($t, $tags)){
                    $tags[] = $t;
                }
            }
        }

        $personnageAleatoire = \Cungfoo\Model\PersonnageQuery::create()
            ->joinWithI18n($locale)
            ->filterByEtablissementId($camping->getId())
            ->addAscendingOrderByColumn('RAND()')
            ->findOne()
        ;

        $resalysParameters = \Symfony\Component\Yaml\Yaml::parse(sprintf('%s/Resalys/parameters.yml', $app['config']->get('config_dir')));

        return $app->renderView('Camping/camping.twig', array(
            'locale'                  => $locale,
            'etab'                    => $camping,
            'personnages'             => $personnages,
            'multimedia'              => $multimedia,
            'tags'                    => $tags,
            'personnageAleatoire'     => $personnageAleatoire,
            'sitesAVisiter'           => $sitesAVisiter,
            'events'                  => $events,
            'resalysParameters'       => $resalysParameters,
            'historyBack'             => $request->headers->get('referer'),
            'referer'                 => $app['url_generator']->generate($request->get('_route'), array(
                'pays' => $camping->getPays()->getSlug(),
                'region' => $camping->getRegion()->getSlug(),
                'ville' => $camping->getVille()->getSlug(),
                'camping' => $camping->getSlug()
            ), true)

        ));
    }
}

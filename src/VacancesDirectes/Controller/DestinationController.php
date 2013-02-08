<?php

namespace VacancesDirectes\Controller;

use Symfony\Component\HttpFoundation\Request,
    Symfony\Component\HttpFoundation\Response,
    Symfony\Component\HttpFoundation\Cookie;

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
    Cungfoo\Model\DestinationQuery,
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
    const DESTINATION_DESTINATION = 'Destination';

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
                ->useI18nQuery($locale)
                    ->filterBySlug($pays)
                ->endUse()
                ->findOne()
            ;

            if (!$paysObject)
            {
                $paysObject = DestinationQuery::create()
                    ->useI18nQuery($locale)
                        ->filterBySlug($pays)
                    ->endUse()
                    ->findOne()
                ;
            }

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
                ->useI18nQuery($locale)
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
                ->useI18nQuery($locale)
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

        $controllers->match('/', function (Request $request, $pays) use ($app)
        {
            $type = get_class($pays) == 'Cungfoo\Model\Pays' ? self::DESTINATION_PAYS : self::DESTINATION_DESTINATION;

            return $this->process($app, $request, $pays, null, null, $type);
        })
        ->bind('destination_pays');

        $controllers->match('/{region}/', function (Request $request, Pays $pays, Region $region) use ($app)
        {
            if ($pays->getId() != $region->getPaysId())
            {
                $app->abort(404, "$region does not exist.");
            }

            return $this->process($app, $request, $pays, $region, null, self::DESTINATION_REGION);
        })
        ->bind('destination_region');

        $controllers->match('/{region}/{ville}/', function (Request $request, Pays $pays, Region $region, Ville $ville) use ($app)
        {
            if ($pays->getId() != $region->getPaysId() || $region->getId() != $ville->getRegionId())
            {
                $app->abort(404, "$ville does not exist.");
            }

            return $this->process($app, $request, $pays, $region, $ville, self::DESTINATION_VILLE);
        })
        ->bind('destination_ville');

        $controllers->match('/{region}/{ville}/{camping}.html', function (Request $request, Pays $pays, Region $region, Ville $ville, Etablissement $camping) use ($app)
        {
            if ($pays->getId() != $region->getPaysId() || $region->getId() != $ville->getRegionId() || $camping->getVilleId() != $ville->getId())
            {
                $app->abort(404, "$camping does not exist.");
            }

            return $this->processEtablissement($app, $request, $camping);
        })
        ->bind('destination_camping');

        return $controllers;
    }

    protected function process(Application $app, Request $request, $pays, $region = null, $ville = null, $destination = self::DESTINATION_PAYS)
    {
        $dateData = $app['session']->get('search_engine_data');
        if (!$dateData)
        {
            $dateData = new \VacancesDirectes\Form\Data\Search\DateData();
        }

        switch ($destination) {
            case self::DESTINATION_DESTINATION:
            case self::DESTINATION_PAYS:
                $item = $pays;
                $urlCanonical = $app['url_generator']->generate($request->get('_route'), array(
                    'pays'      => $item->getSlug(),
                ), true);
                break;

            case self::DESTINATION_REGION:
                $item = $region;
                $urlCanonical = $app['url_generator']->generate($request->get('_route'), array(
                    'pays'      => $item->getPays()->getSlug(),
                    'region'    => $item->getSlug(),
                ), true);
                $dateData->destination = $region->getCode();
                break;

            case self::DESTINATION_VILLE:
                $item = $ville;
                $urlCanonical = $app['url_generator']->generate($request->get('_route'), array(
                    'pays'      => $item->getRegion()->getPays()->getSlug(),
                    'region'    => $item->getRegion()->getSlug(),
                    'ville'     => $item->getSlug(),
                ), true);
                $dateData->destination = $region->getCode();
                $dateData->ville = $ville->getCode();
                break;

            default:
                $app->abort(404, "This route does not exist.");
                break;
        }

        $app['session']->set('search_engine_data', $dateData);

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

        $nbCampings = count($campings);

        $list = new CatalogueListing($app);
        $list
            ->setData($campings)
            ->setType(CatalogueListing::CATALOGUE)
        ;
        $listContent = $list->process();

        // On parcourt tous les campings pour trouver le premier qui a bien des coordonnees saisies afin d'afficher la GMap centree sur cet element
        $firstEtab = null;
        for($i = 0; $i < $nbCampings && (!$firstEtab['model'] || (!$firstEtab['model']->getGeoCoordinateX() && !$firstEtab['model']->getGeoCoordinateY())); $i++)
        {
            $firstEtab = $listContent['element'][$i];
        }

        return $app->renderView('Destination/detail.twig', array(
            'locale'            => $locale,
            'destination'       => $destination,
            'item'              => $item,
            'sitesAVisiter'     => $sitesAVisiter,
            'nbSitesAVisiter'   => $nbSitesAVisiter,
            'events'            => $events,
            'campings'          => $campings,
            'list'              => $listContent,
            'firstEtab'         => $firstEtab,
            'searchForm'        => $searchEngine->getView(),
            'imagesTitle'       => $app->trans('destination.images_' . strtolower($destination) . '_title'),
            'title'             => $app->trans('destination.' . strtolower($destination) . '_title', array('%item%' => $item->getName())),
            'urlCanonical'      => $urlCanonical
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
        foreach ($multimedia as $multi)
        {
            $multimediaTags = $multi->getTags();
            foreach ($multimediaTags as $tag)
            {
                $tags[$tag->getSlug()] = $tag;
            }
        }

        $personnageAleatoire = \Cungfoo\Model\PersonnageQuery::create()
            ->joinWithI18n($locale)
            ->filterByEtablissementId($camping->getId())
            ->addAscendingOrderByColumn('RAND()')
            ->findOne()
        ;

        $webuser = $app['config']->get('languages')[$locale]['resalys_username'];

        // definition des informations relatives au bloc prix de la fiche camping
        $lastProposal = $app['session']->get('last_proposal');

        if (is_array($lastProposal) && is_object($lastProposal['proposal']) && $request->getRequestUri() == $lastProposal['target'])
        {
            $category = \Cungfoo\Model\CategoryTypeHebergementQuery::create()
                ->filterByCode($lastProposal['proposal']->{'room_type_category'})
                ->findOne()
            ;

            $blocPrix['proposal_key']                  = $lastProposal['proposal']->{'proposal_key'};
            $blocPrix['start_date']                    = $lastProposal['proposal']->{'start_date'};
            $blocPrix['end_date']                      = $lastProposal['proposal']->{'end_date'};
            $blocPrix['room_type_label']               = $lastProposal['proposal']->{'room_types'}->{'room_type'}->{'room_type_label'};
            $blocPrix['adult_price_without_discounts'] = $lastProposal['proposal']->{'adult_price_without_discounts'};
            $blocPrix['adult_price']                   = $lastProposal['proposal']->{'adult_price'};
            $blocPrix['adult_price_pourcent']          = round(100 - (100 * $lastProposal['proposal']->{'adult_price'} / $lastProposal['proposal']->{'adult_price_without_discounts'}));
            $blocPrix['category_hebergement']          = $category ? $category->getName() : '';
        }
        else
        {
            $minimumPriceType = $camping->getMinimumPriceType();
            $blocPrix['proposal_key'] = false;
            $blocPrix['start_date']                    = $minimumPriceType ? $minimumPriceType->getMinimumPriceStartDate('d/m/Y') : null;
            $blocPrix['end_date']                      = $minimumPriceType ? $minimumPriceType->getMinimumPriceEndDate('d/m/Y') : null;
            $blocPrix['adult_price_without_discounts'] = $minimumPriceType ? $minimumPriceType->getMinimumPrice() : 0;
            $blocPrix['type_hebergement']              = $minimumPriceType ? $minimumPriceType->getTypeHebergement()->getName() : '';
            $blocPrix['category_hebergement']          = $minimumPriceType ? $minimumPriceType->getTypeHebergement()->getCategoryTypeHebergement()->getName() : '';
        }
        // fin de la définition des informations relatives au bloc prix de la fiche camping

        $trackingCamping = unserialize($app['request']->cookies->get('tracking'));
        if (!$trackingCamping)
        {
            $trackingCamping = array();
        }
        if (!in_array($camping->getCode(), $trackingCamping))
        {
            array_unshift($trackingCamping, $camping->getCode());
        }
        if (count($trackingCamping) > 3)
        {
            array_pop($trackingCamping);
        }
        $cookie = new Cookie('tracking', serialize($trackingCamping), time() + 3600 * 24 * 7);

        $view = $app['twig']->render('Camping/camping.twig', array(
            'locale'                  => $locale,
            'etab'                    => $camping,
            'personnages'             => $personnages,
            'multimedia'              => $multimedia,
            'tags'                    => $tags,
            'personnageAleatoire'     => $personnageAleatoire,
            'sitesAVisiter'           => $sitesAVisiter,
            'events'                  => $events,
            'webuser'                 => $webuser,
            'historyBack'             => $request->headers->get('referer'),
            'hasBaignade'             => count($camping->getEtablissementBaignades()) > 0,
            'blocPrix'                => $blocPrix,
            'referer'                 => $app['url_generator']->generate($request->get('_route'), array(
                'pays'      => $camping->getPays()->getSlug(),
                'region'    => $camping->getRegion()->getSlug(),
                'ville'     => $camping->getVille()->getSlug(),
                'camping'   => $camping->getSlug()
            ), true)

        ));

        $response = new Response($view, 200, array('Surrogate-Control' => 'content="ESI/1.0"'));
        $response->headers->setCookie($cookie);
        return $response;
    }
}

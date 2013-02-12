<?php

namespace VacancesDirectes\Controller;

use Symfony\Component\HttpFoundation\Request;

use Silex\Application,
    Silex\ControllerCollection,
    Silex\ControllerProviderInterface;

use Cungfoo\Model\Pays,
    Cungfoo\Model\PaysQuery,
    Cungfoo\Model\PaysPeer,
    Cungfoo\Model\Region,
    Cungfoo\Model\RegionQuery,
    Cungfoo\Model\RegionPeer,
    Cungfoo\Model\RegionRef,
    Cungfoo\Model\RegionRefQuery,
    Cungfoo\Model\RegionRefPeer,
    Cungfoo\Model\Departement,
    Cungfoo\Model\DepartementQuery,
    Cungfoo\Model\DepartementPeer,
    Cungfoo\Model\Ville,
    Cungfoo\Model\VilleQuery,
    Cungfoo\Model\VillePeer,
    Cungfoo\Model\Etablissement,
    Cungfoo\Model\EtablissementQuery,
    Cungfoo\Model\EtablissementPeer,
    Cungfoo\Model\Destination,
    Cungfoo\Model\DestinationQuery,
    Cungfoo\Model\DestinationPeer,
    Cungfoo\Model\PointInteretPeer,
    Cungfoo\Model\EventPeer;

use VacancesDirectes\Lib\Listing\CatalogueListing,
    VacancesDirectes\Lib\SearchEngine,
    VacancesDirectes\Form\Data\Search\DateData;

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
        $ctl = $app['controllers_factory'];

        $ctl->convert('pays', function ($pays) use ($app) {
            if (!$pays) return;

            $objectItem = PaysQuery::create()
                ->useI18nQuery()
                ->filterBySlug($pays)
                ->endUse()
                ->findOne()
            ;

            if (!$objectItem) {
                $app->abort(404, "L'url $pays ne correspond à aucun pays.");
            }

            return $objectItem;
        });

        $ctl->convert('destination', function ($destination) use ($app) {
            if (!$destination) return;

            $objectItem = DestinationQuery::create()
                ->useI18nQuery()
                ->filterBySlug($destination)
                ->endUse()
                ->findOne()
            ;

            if (!$objectItem) {
                $app->abort(404, "L'url $destination ne correspond à aucune destination.");
            }

            return $objectItem;
        });

        $ctl->convert('region', function ($region) use ($app) {
            if (!$region) return;

            $objectItem = RegionQuery::create()
                ->useI18nQuery()
                ->filterBySlug($region)
                ->endUse()
                ->findOne()
            ;

            if (!$objectItem) {
                $app->abort(404, "L'url $region ne correspond à aucune région.");
            }

            return $objectItem;
        });

        $ctl->convert('regionRef', function ($regionRef) use ($app) {
            if (!$regionRef) return;

            $objectItem = RegionRefQuery::create()
                ->useI18nQuery()
                ->filterBySlug($regionRef)
                ->endUse()
                ->findOne()
            ;

            if (!$objectItem) {
                $app->abort(404, "L'url $regionRef ne correspond à aucune région réferentiel.");
            }

            return $objectItem;
        });

        $ctl->convert('departement', function ($departement) use ($app) {
            if (!$departement) return;

            $objectItem = DepartementQuery::create()
                ->useI18nQuery()
                ->filterBySlug($departement)
                ->endUse()
                ->findOne()
            ;

            if (!$objectItem) {
                $app->abort(404, "L'url $departement ne correspond à aucun département.");
            }

            return $objectItem;
        });

        $ctl->convert('ville', function ($ville) use ($app) {
            if (!$ville) return;

            $objectItem = VilleQuery::create()
                ->useI18nQuery()
                ->filterBySlug($ville)
                ->endUse()
                ->findOne()
            ;

            if (!$objectItem) {
                $app->abort(404, "L'url $ville ne correspond à aucun département.");
            }

            return $objectItem;
        });

        $ctl->convert('camping', function ($camping) {
            if (!$camping) return;

            $objectItem = EtablissementQuery::create()
                ->filterBySlug($camping)
                ->findOne()
            ;

            if (!$objectItem) {
                $app->abort(404, "L'url $camping ne correspond à aucun camping.");
            }

            return $objectItem;
        });

        $assertUrlPays = PaysPeer::assertUrl();
        $assertUrlDestination = DestinationPeer::assertUrl();
        $assertUrlRegion = RegionPeer::assertUrl();
        $assertUrlRegionRef = RegionRefPeer::assertUrl();
        $assertUrlDepartement = DepartementPeer::assertUrl();
        $assertUrlVille = VillePeer::assertUrl();
        $assertUrlCamping = EtablissementPeer::assertUrl();

        $urlPrefix = $app->trans('seo.url.prefix');

        if ($assertUrlDestination) {
            $ctl->match("/$urlPrefix-{destination}/", array($this, 'destination'))
                ->assert('destination', $assertUrlDestination)
                ->bind('destination_destination')
            ;
        }

        if ($assertUrlPays) {
            $ctl->match("/$urlPrefix-{pays}/", array($this, 'pays'))
                ->assert('pays', $assertUrlPays)
                ->bind('destination_pays')
            ;

            if ($assertUrlRegionRef) {
                $ctl->match("/$urlPrefix-{pays}/{regionRef}/", array($this, 'regionRef'))
                    ->assert('pays', $assertUrlPays)
                    ->assert('regionRef', $assertUrlRegionRef)
                    ->bind('destination_region_ref')
                ;
            }

            if ($assertUrlDepartement) {
                $ctl->match("/$urlPrefix-{pays}/{departement}/", array($this, 'departement'))
                    ->assert('pays', $assertUrlPays)
                    ->assert('departement', $assertUrlDepartement)
                    ->bind('destination_departement')
                ;
            }

            if ($assertUrlRegion) {
                $ctl->match("/$urlPrefix-{pays}/{region}/", array($this, 'region'))
                    ->assert('pays', $assertUrlPays)
                    ->assert('region', $assertUrlRegion)
                    ->bind('destination_region')
                ;

                if ($assertUrlVille) {
                    $ctl->match("/$urlPrefix-{pays}/{region}/{ville}/", array($this, 'ville'))
                        ->assert('pays', $assertUrlPays)
                        ->assert('region', $assertUrlRegion)
                        ->assert('ville', $assertUrlVille)
                        ->bind('destination_ville')
                    ;

                    if ($assertUrlCamping) {
                        $ctl->match("/$urlPrefix-{pays}/{region}/{ville}/{camping}.html", array($this, 'camping'))
                            ->assert('pays', $assertUrlPays)
                            ->assert('region', $assertUrlRegion)
                            ->assert('ville', $assertUrlVille)
                            ->assert('camping', $assertUrlCamping)
                            ->bind('destination_camping')
                        ;
                    }
                }
            }
        }

        return $ctl;
    }

    protected function process(Application $app, Request $request, $object) {
        $locale = $app['context']->get('language');

        // nom de l'objet courant
        $explodedObjectClassName = explode('\\', get_class($object));
        $objectName = end($explodedObjectClassName);

        // récupère les informations du form de recherche stocké en session
        $dateData = $app['session']->get('search_engine_data');
        if (!$dateData) {
            $dateData = new DateData();
        }

        switch (get_class($object)) {
            case 'Cungfoo\Model\Region':
            case 'Cungfoo\Model\RegionRef':
                $dateData->destination = $object->getCode();
                break;
            case 'Cungfoo\Model\Ville':
                $dateData->destination = $object ->getRegion()->getCode();
                $dateData->ville = $object->getCode();
                break;
        }

        // modification des informations du form de recherche
        $app['session']->set('search_engine_data', $dateData);

        // création du formulaire de recherche
        $searchEngine = new SearchEngine($app, $request);
        $searchEngine->process($dateData);

        // si le formulaire de recherche vient d'être soumis on redirige
        if ($searchEngine->getRedirect()) {
            return $app->redirect($searchEngine->getRedirect());
        }

        // nom des méthodes de récupération des informations
        $getForMethod      = sprintf("getFor%s", $objectName);
        $getCountForMethod = sprintf("getCountFor%s", $objectName);

        $sitesAVisiter   = PointInteretPeer::$getForMethod($object, PointInteretPeer::RANDOM_SORT, 5);
        $nbSitesAVisiter = PointInteretPeer::$getCountForMethod($object);
        $events          = EventPeer::$getForMethod($object, EventPeer::SORT_BY_PRIORITY, 9);
        $campings        = EtablissementPeer::$getForMethod($object, EtablissementPeer::RANDOM_SORT);
        $nbCampings      = count($campings);

        // génération de la liste d'établissements
        $listing = new CatalogueListing($app);

        $listContent = $listing
            ->setData($campings)
            ->setType(CatalogueListing::CATALOGUE)
            ->process()
        ;

        // On parcourt tous les campings pour trouver le premier qui a bien des coordonnees saisies afin d'afficher la GMap centree sur cet element
        $firstEtab = null;
        for($i = 0; $i < $nbCampings && (!$firstEtab['model'] || (!$firstEtab['model']->getGeoCoordinateX() && !$firstEtab['model']->getGeoCoordinateY())); $i++)
        {
            $firstEtab = $listContent['element'][$i];
        }

        // gestion des canonical
        switch (get_class($object)) {
            case 'Cungfoo\Model\Pays':
                $urlCanonical = $app->url($request->get('_route'), array('pays' => $object->getSlug()));
                break;
            case 'Cungfoo\Model\Destination':
                $urlCanonical = $app->url($request->get('_route'), array('destination' => $object->getSlug()));
                break;
            case 'Cungfoo\Model\Region':
                $urlCanonical = $app->url($request->get('_route'), array(
                    'pays'   => $object->getPays()->getSlug(),
                    'region' => $object->getSlug(),
                ));
                break;
            case 'Cungfoo\Model\RegionRef':
                $urlCanonical = $app->url($request->get('_route'), array(
                    'pays'   => $object->getPays()->getSlug(),
                    'regionRef' => $object->getSlug(),
                ));
                break;
            case 'Cungfoo\Model\Departement':
                $urlCanonical = $app->url($request->get('_route'), array(
                    'pays'   => $object->getRegionRef()->getPays()->getSlug(),
                    'departement' => $object->getSlug(),
                ));
                break;
            case 'Cungfoo\Model\Ville':
                $urlCanonical = $app->url($request->get('_route'), array(
                    'pays'   => $object->getRegion()->getPays()->getSlug(),
                    'region' => $object->getRegion()->getSlug(),
                    'ville'  => $object->getSlug(),
                ));
                break;
            default:
                $urlCanonical = null;
                break;
        }

        return $app->renderView(sprintf('Destination/%s.twig', strtolower($objectName)), array(
            'locale'          => $locale,
            'item'            => $object,
            'sitesAVisiter'   => $sitesAVisiter,
            'nbSitesAVisiter' => $nbSitesAVisiter,
            'events'          => $events,
            'campings'        => $campings,
            'list'            => $listContent,
            'firstEtab'       => $firstEtab,
            'searchForm'      => $searchEngine->getView(),
            'imagesTitle'     => $app->trans('destination.images_' . strtolower($objectName) . '_title'),
            'title'           => $app->trans('destination.' . strtolower($objectName) . '_title', array('%item%' => $object->getName())),
            'urlCanonical'    => $urlCanonical
        ));
    }

    function pays(Application $app, Request $request, Pays $pays) {
        return $this->process($app, $request, $pays);
    }

    function destination(Application $app, Request $request, Destination $destination) {
        return $this->process($app, $request, $destination);
    }

    function region(Application $app, Request $request, Pays $pays, Region $region) {
        return $this->process($app, $request, $region);
    }

    function regionRef(Application $app, Request $request, Pays $pays, RegionRef $regionRef) {
        return $this->process($app, $request, $regionRef);
    }

    function departement(Application $app, Request $request, Pays $pays, Departement $departement) {
        return $this->process($app, $request, $departement);
    }

    function ville(Application $app, Request $request, Pays $pays, Region $region, Ville $ville) {
        return $this->process($app, $request, $ville);
    }

    function camping(Application $app, Request $request, Pays $pays, Region $region, Etablissement $camping) {

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

        return $app->renderView('Camping/camping.twig', array(
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
    }
}

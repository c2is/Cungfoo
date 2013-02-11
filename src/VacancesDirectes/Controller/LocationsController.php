<?php

namespace VacancesDirectes\Controller;

use Symfony\Component\HttpFoundation\Request;

use Silex\Application,
    Silex\ControllerCollection,
    Silex\ControllerProviderInterface;

use Cungfoo\Model\Etablissement,
    Cungfoo\Model\EtablissementQuery,
    Cungfoo\Model\EtablissementPeer,
    Cungfoo\Model\Theme;

use VacancesDirectes\Lib\Listing\CatalogueListing,
    VacancesDirectes\Lib\SearchEngine;

class LocationsController implements ControllerProviderInterface
{
    /**
     * {@inheritdoc}
     */
    public function connect(Application $app)
    {
        $controllers = $app['controllers_factory'];

        $controllers->convert('categoryTypeHebergement', function($categoryTypeHebergement) use ($app)
        {
            $locale = $app['context']->get('language');

            $categoryTypeHebergementObject = \Cungfoo\Model\CategoryTypeHebergementQuery::create()
                ->useI18nQuery($locale)
                    ->filterBySlug($categoryTypeHebergement)
                ->endUse()
                ->findOne()
            ;

            if (!$categoryTypeHebergementObject)
            {
                $capaciteObject = \Cungfoo\Model\TypeHebergementCapaciteQuery::create()
                    ->useI18nQuery($locale)
                        ->filterBySlug($categoryTypeHebergement)
                    ->endUse()
                    ->findOne()
                ;

                if (!$capaciteObject)
                {
                    $app->abort(404, "$categoryTypeHebergement does not exist.");
                }

                return $capaciteObject;
            }

            return $categoryTypeHebergementObject;
        });

        $controllers->convert('typeHebergement', function($typeHebergement) use ($app)
        {
            if (!$typeHebergement)
            {
                return;
            }

            $locale = $app['context']->get('language');

            $typeHebergementObject = \Cungfoo\Model\TypeHebergementQuery::create()
                ->useI18nQuery($locale)
                    ->filterBySlug($typeHebergement)
                ->endUse()
                ->findOne()
            ;

            if (!$typeHebergementObject)
            {
                $app->abort(404, "$typeHebergement does not exist.");
            }

            return $typeHebergementObject;
        });

        $controllers->match('/{categoryTypeHebergement}/', function (Request $request, $categoryTypeHebergement) use ($app)
        {
            $dateData = new \VacancesDirectes\Form\Data\Search\DateData();

            $locale = $app['context']->get('language');

            // Formulaire de recherche
            $searchEngine = new SearchEngine($app, $request);
            $searchEngine->process($dateData);

            if ($searchEngine->getRedirect())
            {
                return $app->redirect($searchEngine->getRedirect());
            }

            return $app->renderView('Locations/list.twig', array(
                'locale'                  => $locale,
                'currentClass'            => get_class($categoryTypeHebergement),
                'categoryTypeHebergement' => $categoryTypeHebergement,
                'searchForm'              => $searchEngine->getView(),
            ));
        })
        ->bind('location_category_type_hebergement');

        $controllers->match('/{categoryTypeHebergement}/{typeHebergement}/', function (Request $request, $categoryTypeHebergement, $typeHebergement) use ($app)
        {
            $dateData = new \VacancesDirectes\Form\Data\Search\DateData();

            $locale = $app['context']->get('language');

            $canonical = false;
            if (get_class($categoryTypeHebergement) != 'Cungfoo\\Model\\CategoryTypeHebergement')
            {
                $categoryTypeHebergementObject = \Cungfoo\Model\CategoryTypeHebergementQuery::create()
                    ->joinWithI18n($locale)
                    ->filterByTypeHebergement($typeHebergement)
                    ->findOne()
                ;

                $canonical = $app['url_generator']->generate('location_type_hebergement', array('categoryTypeHebergement' => $categoryTypeHebergementObject->getSlug(), 'typeHebergement' => $typeHebergement->getSlug()));
            }

            $regions = \Cungfoo\Model\RegionQuery::create()
                ->useVilleQuery()
                    ->useEtablissementQuery()
                        ->filterByTypeHebergement($typeHebergement)
                    ->endUse()
                ->endUse()
                ->usei18nQuery()
                    ->orderBy('Name')
                ->endUse()
                ->distinct()
                ->findActive();
            ;

            // Formulaire de recherche
            $searchEngine = new SearchEngine($app, $request);
            $searchEngine->process($dateData);

            if ($searchEngine->getRedirect())
            {
                return $app->redirect($searchEngine->getRedirect());
            }

            $campings = $typeHebergement->getEtablissements();
            $list = new CatalogueListing($app);
            $list
                ->setData($campings)
                ->setType(CatalogueListing::CATALOGUE)
            ;
            $listContent = $list->process();

            return $app->renderView('Locations/fiche.twig', array(
                'locale'                  => $locale,
                'categoryTypeHebergement' => $categoryTypeHebergement,
                'typeHebergement'         => $typeHebergement,
                'list'                    => $listContent,
                'searchForm'              => $searchEngine->getView(),
                'canonical'               => $canonical,
                'regions'                 => $regions,
            ));
        })
        ->bind('location_type_hebergement');

        return $controllers;
    }
}

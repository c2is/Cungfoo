<?php

namespace VacancesDirectes\Controller;

use Silex\Application,
    Silex\ControllerCollection,
    Silex\ControllerProviderInterface;

use Symfony\Component\HttpFoundation\Request,
    Symfony\Component\HttpKernel\Exception\NotFoundHttpException,
    Symfony\Component\HttpFoundation\Response,
    Symfony\Component\Routing\Route;

use Cungfoo\Model\EtablissementQuery,
    Cungfoo\Model\PointInteretPeer,
    Cungfoo\Model\EventPeer,
    Cungfoo\Model\BonPlanQuery,
    Cungfoo\Model\BonPlanPeer,
    Cungfoo\Model\BonPlanCategoriePeer,
    Cungfoo\Model\BonPlanCategorieQuery;

use VacancesDirectes\Lib\Listing,
    VacancesDirectes\Lib\SearchEngine,
    VacancesDirectes\Lib\SearchParams,
    VacancesDirectes\Lib\Listing\DispoListing;

use Resalys\Lib\Client\DisponibiliteClient;

class BonsPlansController implements ControllerProviderInterface
{
    /**
     * {@inheritdoc}
     */
    public function connect(Application $app)
    {
        $controllers = $app['controllers_factory'];

        $locale = $app['context']->get('language');

        $assertUrlBonPlans = BonPlanPeer::assertUrl($locale);
        $assertUrlBonPlanCategorie = BonPlanCategoriePeer::assertUrl($locale);

        $controllers->match('/{slug}/', function (Request $request, $slug) use ($app)
        {
            $locale = $app['context']->get('language');

            $bonPlanObject = BonPlanQuery::create()
                ->useI18nQuery($locale)
                    ->filterBySlug($slug)
                ->endUse()
                ->findOne()
            ;

            if (!$bonPlanObject)
            {
                $app->abort(404, "La page recherchée n'existe pas");
            }

            $dateData = new \VacancesDirectes\Form\Data\Search\DateData();
            $dateData->dateDebut    = $bonPlanObject->getDateStart()->format('d/m/Y');
            $dateData->nbJours      = $bonPlanObject->getDayRange();
            $dateData->nbAdultes    = $bonPlanObject->getNbAdultes();
            $dateData->nbEnfants    = $bonPlanObject->getNbEnfants();

            $searchEngine = new SearchEngine($app, $request);
            $searchEngine->process($dateData);
            if ($searchEngine->getRedirect())
            {
                return $app->redirect($searchEngine->getRedirect());
            }

            $startDate  = $bonPlanObject->getDateStart('U') ?: date('U');
            $dayRange = $bonPlanObject->getDayRange() ?: 7;

            $searchParams = new SearchParams($app);
            $searchParams
                ->setStartDate(date('Y-m-d', $startDate))
                ->setNbDays($dayRange)
                ->addTheme($bonPlanObject->getRegionsCodes())
                ->addEtab($bonPlanObject->getEtablissementsCodes())
                ->setNbAdults($bonPlanObject->getNbAdultes())
                ->setNbChildren($bonPlanObject->getNbEnfants())
            ;

            $client = new DisponibiliteClient($app['config']->get('root_dir'), $app['context']->get('language'));
            $client->addOptions($searchParams->generate());

            $listing = new DispoListing($app);
            $listing->setClient($client);

            $listingContent = $listing->process();

            return $app->renderView('BonsPlans\base.twig', array(
                'bonPlan'         => $bonPlanObject,
                'list'            => $listingContent,
                'firstEtab'       => reset($listingContent['element']),
                'searchForm'      => $searchEngine->getView(),
            ));
        })
        ->assert('slug', $assertUrlBonPlans)
        ->bind('bonsplans');

        $controllers->match('/{cat}/', function (Request $request, $cat) use ($app)
        {
            $locale = $app['context']->get('language');

            $categorie = BonPlanCategorieQuery::create()
                ->useI18nQuery($locale)
                    ->filterBySlug($cat)
                ->endUse()
                ->findOne()
            ;

            if (!$categorie)
            {
                $app->abort(404, "La page recherchée n'existe pas");
            }

            $searchEngine = new SearchEngine($app, $request);
            $searchEngine->process($app['session']->get('search_engine_data'));
            if ($searchEngine->getRedirect())
            {
                return $app->redirect($searchEngine->getRedirect());
            }

            $bonsPlans = BonPlanQuery::create()
                ->joinWithI18n($locale)
                ->filterByBonPlanCategorie($categorie)
                ->findActive()
            ;

            return $app->renderView('BonsPlansCategorie\index.twig', array(
                'categorie'       => $categorie,
                'bonsPlans'       => $bonsPlans,
                'searchForm'      => $searchEngine->getView(),
            ));
        })
        ->assert('cat', $assertUrlBonPlanCategorie)
        ->bind('categorie_bonsplans');

        $controllers->match('/camping-ascension/', function (Request $request) use ($app)
        {
            return $app['twig']->render('BonsPlans/index.twig', array(
                'seo' => "pont de l'ascension",
                'title' => "NOS OFFRES CAMPINGS : PONT DE L'ASCENSION",
                'accroche' => "Besoin d'un week-end prolongé sous le soleil printanier du mois de mai pour l'Ascension ?!",
                'description' => "Découvrez toutes nos offres de locations de mobil homes en camping pour le week-end de l'Ascension proposées par Vacances directes et réserver en ligne."
            ));

        })->bind('bonsplans_ascension');

        $controllers->match('/camping-8-mai/', function (Request $request) use ($app)
        {
            return $app['twig']->render('BonsPlans/index.twig', array(
                'seo' => "pont du 8 mai",
                'title' => "NOS OFFRES CAMPINGS : PONT DU 8 MAI",
                'accroche' => "Besoin d'un week-end prolongé sous le soleil printanier pour le pont du 8 mai ?!",
                'description' => "Découvrez toutes nos offres de locations de mobil homes en camping pour le pont du 8 mai proposées par Vacances directes et réserver en ligne."
            ));

        })->bind('bonsplans_8mai');

        $controllers->match('/camping-1er-mai/', function (Request $request) use ($app)
        {
            return $app['twig']->render('BonsPlans/index.twig', array(
                'seo' => "pont du 1er mai",
                'title' => "NOS OFFRES CAMPINGS : PONT DU 1ER MAI",
                'accroche' => "Besoin d'un week-end prolongé sous le soleil printanier pour le pont du 1er mai ?!",
                'description' => "Découvrez toutes nos offres de locations de mobil homes en camping pour le pont du 1er mai proposées par Vacances directes et réserver en ligne."
            ));

        })->bind('bonsplans_1mai');

        $controllers->match('/camping-pentecote/', function (Request $request) use ($app)
        {
            return $app['twig']->render('BonsPlans/index.twig', array(
                'seo' => "week-end de la pentecôte",
                'title' => "NOS OFFRES CAMPINGS : WEEK-END DE LA PENTECÔTE",
                'accroche' => "Besoin d'un week-end prolongé sous le soleil printanier du mois de mai pour la Pentecôte ?!",
                'description' => "Découvrez toutes nos offres de locations de mobil homes en camping pour le week-end de la Pentecôte proposées par Vacances directes et réserver en ligne."
            ));

        })->bind('bonsplans_pentecote');

        $controllers->match('/camping-dernieres-minutes/', function (Request $request) use ($app)
        {
            return $app['twig']->render('BonsPlans/index.twig', array(
                'seo' => "dernieres minutes",
                'title' => "NOS OFFRES DE CAMPINGS EN DERNIÈRES MINUTES (LOCATION MOBIL HOME)",
                'description' => "Découvrez toutes les offres de locations de mobil homes en dernières minutes en camping proposées par Vacances directes et réserver en ligne.",
                'metaDescription' => "Découvrez toutes les offres de locations de mobil homes en dernières minutes en camping proposées par Vacances directes et réserver en ligne.",
            ));

        })->bind('bonsplans_dernieres_minutes');

        return $controllers;
    }
}

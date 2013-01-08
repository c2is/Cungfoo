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
    Cungfoo\Model\BonPlanQuery;

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

        $controllers->match('/camping-{slug}/', function (Request $request, $slug) use ($app)
        {
            $locale = $app['context']->get('language');

            $bonPlanObject = BonPlanQuery::create()
                ->joinWithI18n($locale)
                ->useBonPlanI18nQuery()
                    ->filterBySlug($slug)
                ->endUse()
                ->filterByActive(true)
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

            $baseDate  = $bonPlanObject->getDateStart('U') ?: date('U');
            $startDate = strtotime('next ' . $bonPlanObject->getDayStart(), $baseDate);
            $startDate = strtotime('+' . ($bonPlanObject->getDayRange() - 7) . ' days', $startDate);

            $searchParams = new SearchParams($app);
            $searchParams
                ->setStartDate(date('Y-m-d', $startDate))
                ->setNbDays(7)
                ->addTheme($bonPlanObject->getDestinationsCodes())
                ->addEtab($bonPlanObject->getEtablissementsCodes())
                ->setNbAdults($bonPlanObject->getNbAdultes())
                ->setNbChildren($bonPlanObject->getNbEnfants())
                ->setMaxResults(50)
            ;

            $client = new DisponibiliteClient($app['config']->get('root_dir'));
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
        })->bind('bonsplans');

        return $controllers;
    }
}
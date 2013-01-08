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

        $controllers->match('/camping-{slug}/', function (Request $request, $slug) use ($app)
        {
            $locale = $app['context']->get('language');

            $bonPlanObject = BonPlanQuery::create()
                ->joinWithI18n($locale)
                ->useBonPlanI18nQuery()
                    ->filterBySlug($slug)
                ->endUse()
                ->findOne()
            ;

            if (!$bonPlanObject)
            {
                $app->abort(404, "$slug does not exist.");
            }

            $searchEngine = new SearchEngine($app, $request);
            $searchEngine->process();
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
                ->setNbAdults(1)
                ->setMaxResults(50)
            ;

            $client = new DisponibiliteClient($app['config']->get('root_dir'));
            $client->addOptions($searchParams->generate());

            $listing = new DispoListing($app);
            $listing->setClient($client);

            $listingContent = $listing->process();

            return $app->renderView('Research\dispo.twig', array(
                'title'           => $app->trans('seo.title.early_booking'),
                'metaDescription' => $app->trans('seo.meta.early_booking'),
                'texteOffre'      => $app->trans('offreSpeciales.texte'),
                'intro'      => $app->trans('offreSpeciales.intro'),
                'h1' => $app->trans('earlyBooking.h1'),
                'list'            => $listingContent,
                'firstEtab'       => reset($listingContent['element']),
                'searchForm'      => $searchEngine->getView(),
            ));
        })->bind('bonsplans');

        return $controllers;
    }
}
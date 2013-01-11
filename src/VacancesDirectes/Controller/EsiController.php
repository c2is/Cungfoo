<?php

namespace VacancesDirectes\Controller;

use Silex\Application,
    Silex\ControllerCollection,
    Silex\ControllerProviderInterface;

use Symfony\Component\HttpFoundation\Request,
    Symfony\Component\HttpKernel\Exception\NotFoundHttpException,
    Symfony\Component\HttpFoundation\Response,
    Symfony\Component\Routing\Route;

use Cungfoo\Model\BonPlanQuery;

use VacancesDirectes\Lib\SearchParams,
    VacancesDirectes\Lib\Listing\DispoListing;

use Resalys\Lib\Client\DisponibiliteClient;

class EsiController implements ControllerProviderInterface
{
    /**
     * {@inheritdoc}
     */
    public function connect(Application $app)
    {
        $controllers = $app['controllers_factory'];

        $controllers->match('/early-booking', function (Request $request) use ($app)
        {
            $listing = null;

            try
            {
                $dernieresMinutes = BonPlanQuery::create()
                    ->filterByPushHome(true)
                    ->findOne()
                ;

                if ($dernieresMinutes)
                {
                    $baseDate  = $dernieresMinutes->getDateStart('U') ?: date('U');
                    $startDate = strtotime('next ' . $dernieresMinutes->getDayStart(), $baseDate);
                    $startDate = strtotime('+' . ($dernieresMinutes->getDayRange() - 7) . ' days', $startDate);

                    $searchParams = new SearchParams($app);
                    $searchParams
                        ->setStartDate(date('Y-m-d', $startDate))
                        ->setNbDays(7)
                        ->addTheme($dernieresMinutes->getRegionsCodes())
                        ->addEtab($dernieresMinutes->getEtablissementsCodes())
                        ->setNbAdults(1)
                        ->setMaxResults(10)
                    ;

                    $client = new DisponibiliteClient($app['config']->get('root_dir'));
                    $client->addOptions($searchParams->generate());

                    $listing = new DispoListing($app);
                    $listing
                        ->setClient($client)
                        ->distinct()
                        ->limit(4)
                    ;
                }
            }
            catch (\Exception $e)
            {
                // TODO : gestion d'erreur
            }

            $liste = null;
            if($listing) {
                $liste = $listing->process();
            }

            $view = $app->renderView('Esi/earlyBooking.twig', array(
                'early_booking' => $liste,
            ));

            return new Response($view, 200, array('Cache-Control' => 's-maxage=600, public'));

        })->bind('esi_early_booking');

        $controllers->match('/bon-plan/{slug}/{limit}', function (Request $request, $slug, $limit) use ($app)
        {
            $listing = null;

            try
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

                $baseDate  = $bonPlanObject->getDateStart('U') ?: date('U');
                $startDate = strtotime('next ' . $bonPlanObject->getDayStart(), $baseDate);
                $startDate = strtotime('+' . ($bonPlanObject->getDayRange() - 7) . ' days', $startDate);

                $searchParams = new SearchParams($app);
                $searchParams
                    ->setStartDate(date('Y-m-d', $startDate))
                    ->setNbDays(7)
                    ->addTheme($bonPlanObject->getRegionsCodes())
                    ->addEtab($bonPlanObject->getEtablissementsCodes())
                    ->setNbAdults($bonPlanObject->getNbAdultes())
                    ->setNbChildren($bonPlanObject->getNbEnfants())
                    ->setPeriodCategories($bonPlanObject->getPeriodCategories())
                    ->setMaxResults(10)
                ;

                $client = new DisponibiliteClient($app['config']->get('root_dir'));
                $client->addOptions($searchParams->generate());

                $listing = new DispoListing($app);
                $listing
                    ->setClient($client)
                    ->distinct()
                    ->limit($limit)
                ;
            }
            catch (\Exception $e)
            {
                // TODO : gestion d'erreur
            }

            $liste = null;
            if($listing) {
                $liste = $listing->process();
            }

            $view = $app->renderView('Esi/bonPlan.twig', array(
                'bon_plan' => $listing->process(),
            ));

            return new Response($view, 200, array('Cache-Control' => 's-maxage=600, public'));

        })->bind('esi_bon_plan')
          ->value('limit', '5');

        return $controllers;
    }
}

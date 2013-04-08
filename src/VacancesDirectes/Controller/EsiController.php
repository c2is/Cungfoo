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

        $controllers->match('/bon-plan-home', function (Request $request) use ($app)
        {
            $listing = null;
            $maxAge = 3600;

            try
            {
                $bonPlan = BonPlanQuery::create()
                    ->filterByPushHome(true)
                    ->addDateFilters()
                    ->findOne()
                ;

                if ($bonPlan)
                {
                    $startDate  = $bonPlan->getDateStart('U') ?: date('U');
                    $dayRange = $bonPlan->getDayRange() ?: 7;
                    //$startDate = strtotime('next ' . $bonPlanObject->getDayStart(), strtotime('yesterday', $baseDate));
                    //$startDate = strtotime('+' . ($bonPlan->getDayRange() - 7) . ' days', $startDate);

                    $searchParams = new SearchParams($app);
                    $searchParams
                        ->setStartDate(date('Y-m-d', $startDate))
                        ->setNbDays($dayRange)
                        ->addTheme($bonPlan->getRegionsCodes())
                        ->addEtab($bonPlan->getEtablissementsCodes())
                        ->addRoomType($bonPlan->getTypeHebergementsCodes())
                        ->setNbAdults($bonPlan->getNbAdultes())
                        ->setPeriodCategories($bonPlan->getPeriodCategories())
                        ->setMaxResults(15)
                        ->setSortString('Random')
                    ;

                    if($bonPlan->getNbEnfants() > 0) {
                        $searchParams->setNbChildren($bonPlan->getNbEnfants());
                    }

                    $client = new DisponibiliteClient($app['config']->get('root_dir'), $app['context']->get('language'));
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
                $app['logger']->addError(sprintf('Erreur au chargement du widget home early booking : %s', $e->getMessage()));
                $maxAge = 0;
            }

            $liste = null;
            if($listing) {
                $liste = $listing->process();
            }

            $view = $app['twig']->render('Esi/homeWidget.twig', array(
                'bon_plan'  => $bonPlan,
                'dispos'    => $liste,
            ));

            return new Response($view, 200, array('Cache-Control' => sprintf('s-maxage=%s, public', $maxAge)));

        })->bind('esi_home_widget');

        $controllers->match('/bon-plan/{slug}/{limit}', function (Request $request, $slug, $limit) use ($app)
        {
            $listing = null;
            $maxAge = 3600;

            try
            {
                $locale = $app['context']->get('language');

                $bonPlanObject = BonPlanQuery::create()
                    ->joinWithI18n($locale)
                    ->useBonPlanI18nQuery()
                        ->filterBySlug($slug)
                    ->endUse()
                    ->filterByActive(true)
                    ->addDateFilters()
                    ->findOne()
                ;

                if (!$bonPlanObject)
                {
                    $app->abort(404, "La page recherchée n'existe pas");
                }

                $startDate  = $bonPlanObject->getDateStart('U') ?: date('U');
                $dayRange = $bonPlanObject->getDayRange() ?: 7;
                //$startDate = strtotime('next ' . $bonPlanObject->getDayStart(), strtotime('yesterday', $baseDate));
                //$startDate = strtotime('+' . ($bonPlanObject->getDayRange() - 7) . ' days', $startDate);

                $searchParams = new SearchParams($app);
                $searchParams
                    ->setStartDate(date('Y-m-d', $startDate))
                    ->setNbDays($dayRange)
                    ->addTheme($bonPlanObject->getRegionsCodes())
                    ->addEtab($bonPlanObject->getEtablissementsCodes())
                    ->addRoomType($bonPlanObject->getTypeHebergementsCodes())
                    ->setNbAdults($bonPlanObject->getNbAdultes())
                    ->setPeriodCategories($bonPlanObject->getPeriodCategories())
                    ->setMaxResults(15)
                    ->setSortString('Random')
                ;

                if($bonPlanObject->getNbEnfants() > 0) {
                    $searchParams->setNbChildren($bonPlanObject->getNbEnfants());
                }

                $client = new DisponibiliteClient($app['config']->get('root_dir'), $app['context']->get('language'));
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
                $app['logger']->addError(sprintf('Erreur au chargement du menu Bons Plans : %s', $e->getMessage()));
                $maxAge = 0;
            }

            $liste = null;
            if($listing) {
                $liste = $listing->process();
            }

            $view = $app['twig']->render('Esi/bonPlan.twig', array(
                'bon_plan' => $liste,
            ));

            return new Response($view, 200, array('Cache-Control' => sprintf('s-maxage=%s, public', $maxAge)));

        })->bind('esi_bon_plan')
          ->value('limit', '5')
        ;

        $controllers->convert('bonPlan', function($bonPlan) {
            $bonPlanObject = BonPlanQuery::create()
                ->filterById($bonPlan)
                ->findOne()
            ;

            return $bonPlanObject;
        });

        $controllers->get('/bon-plan-page/{bonPlan}', function (Request $request, $bonPlan) use ($app) {
            $maxAge = 2700;

            $startDate  = $bonPlan->getDateStart('U') ?: date('U');
            $dayRange = $bonPlan->getDayRange() ?: 7;

            $searchParams = new SearchParams($app);
            $searchParams
                ->setStartDate(date('Y-m-d', $startDate))
                ->setNbDays($dayRange)
                ->addTheme($bonPlan->getRegionsCodes())
                ->addEtab($bonPlan->getEtablissementsCodes())
                ->addRoomType($bonPlan->getTypeHebergementsCodes())
                ->setNbAdults($bonPlan->getNbAdultes())
                ->setNbChildren($bonPlan->getNbEnfants())
            ;

            $client = new DisponibiliteClient($app['config']->get('root_dir'), $app['context']->get('language'));
            $client->addOptions($searchParams->generate());

            $listing = new DispoListing($app);
            $listing->setClient($client);

            $listingContent = $listing->process();

            $view = $app['twig']->render('Esi/bonPlanPage.twig', array(
                'list' => $listingContent,
            ));

            return new Response($view, 200, array('Cache-Control' => sprintf('s-maxage=%s, public', $maxAge)));
        })
        ->bind('esi_bon_plan_page');

        return $controllers;
    }
}

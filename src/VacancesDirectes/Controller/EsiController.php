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
use Cungfoo\Model\Etablissement;
use Cungfoo\Model\EtablissementQuery;
use Cungfoo\Model\EtablissementPeer;
use Cungfoo\Model\PointInteretPeer;
use Cungfoo\Model\EventPeer;
use Cungfoo\Model\PortfolioMediaQuery;
use Cungfoo\Model\PersonnageQuery;

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
        $assertUrlCamping = EtablissementPeer::assertUrl();

        $controllers = $app['controllers_factory'];

        $controllers->convert('camping', function ($camping) use ($app) {
            if (!$camping) return;

            $objectItem = EtablissementQuery::create()
                ->filterBySlug($camping)
                ->filterByActive(true)
                ->findOne()
            ;

            if (!$objectItem) {
                $app->abort(404, "L'url $camping ne correspond à aucun camping.");
            }

            return $objectItem;
        });

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

            return new Response($view, 200, array('Cache-Control' => sprintf('public, max-age=%s, must-revalidate', $maxAge)));

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

            return new Response($view, 200, array('Cache-Control' => sprintf('public, max-age=%s, must-revalidate', $maxAge)));

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
                'list'      => $listingContent,
                'firstEtab' => reset($listingContent['element']),
            ));

            return new Response($view, 200, array('Cache-Control' => sprintf('public, max-age=%s, must-revalidate', $maxAge)));
        })
        ->bind('esi_bon_plan_page');

        $controllers->match('/esi-mea', function (Request $request) use ($app)
        {
            $locale = $app['context']->get('language');

            $mea = \Cungfoo\Model\MiseEnAvantQuery::create()
                ->joinWithI18n($locale)
                ->addAscendingOrderByColumn('sortable_rank')
                ->filterByDateFinValidite(date('Y-m-d H:i:s'), \Criteria::GREATER_EQUAL)
                ->findActive()
            ;

            $view = $app['twig']->render('Homepage/mea.twig', array(
                'mea' => $mea,
            ));

            return new Response($view, 200, array('Cache-Control' => sprintf('public, max-age=%s, must-revalidate', $app['config']->get('vd_config')['httpcache']['home'])));
        })
        ->bind('homepage_mea');

        $controllers->match("/esi-{camping}", function (Request $request, Etablissement $camping) use ($app)
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

            $sliderIds = $camping->getSlider();

            $tags = array();
            foreach (explode(';', $sliderIds) as $sliderId)
            {
                $slider = PortfolioMediaQuery::create()
                    ->filterById($sliderId)
                    ->findOne()
                ;

                if ($slider)
                {
                    $multimediaTags = $slider->getPortfolioTags();

                    foreach ($multimediaTags as $tag)
                    {
                        if ($tag->getPortfolioTagCategory() && $tag->getPortfolioTagCategory()->getSlug() == 'camping')
                        {
                            $tags[$tag->getSlug()] = $tag;
                        }
                    }
                }
            }

            $personnageAleatoire = \Cungfoo\Model\PersonnageQuery::create()
                ->joinWithI18n($locale)
                ->filterByEtablissementId($camping->getId())
                ->addAscendingOrderByColumn('RAND()')
                ->findOne()
            ;

            $view = $app['twig']->render('Camping/camping.esi.twig', array(
                'locale'                  => $locale,
                'etab'                    => $camping,
                'personnages'             => $personnages,
                'tags'                    => $tags,
                'personnageAleatoire'     => $personnageAleatoire,
                'sitesAVisiter'           => $sitesAVisiter,
                'events'                  => $events,
            ));

            return new Response($view, 200, array('Cache-Control' => sprintf('public, max-age=%s, must-revalidate', $app['config']->get('vd_config')['httpcache']['camping'])));
        })
        ->assert('camping', $assertUrlCamping)
        ->bind('esi_camping')
        ;

        $controllers->get('/list/item/{camping}', function (Request $request, Etablissement $camping) use ($app)
        {
            $maxAge = 3600;

            $locale = $app['context']->get('language');

            $view = $app['twig']->render('Camping/list_item.twig', array(
                'list' => array('type' => 0),
                'etab' => array('model' => $camping),
            ));

            return new Response($view, 200, array('Cache-Control' => sprintf('public, max-age=%s, must-revalidate', $maxAge)));
        })->bind('camping_list_item');

        return $controllers;
    }
}

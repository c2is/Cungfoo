<?php

namespace VacancesDirectes\Controller;

use Silex\Application,
    Silex\ControllerCollection,
    Silex\ControllerProviderInterface;

use Symfony\Component\HttpFoundation\Request,
    Symfony\Component\HttpFoundation\Response,
    Symfony\Component\HttpKernel\Exception\NotFoundHttpException,
    Symfony\Component\Routing\Route;

use Cungfoo\Model\EtablissementPeer,
    Cungfoo\Model\RegionQuery,
    Cungfoo\Model\DestinationQuery,
    Cungfoo\Model\BonPlanCategorieQuery,
    Cungfoo\Model\BonPlanQuery;

use VacancesDirectes\Form\Type\Destination\AutocompleteType;

use \Criteria;

class MenuController implements ControllerProviderInterface
{
    /**
     * {@inheritdoc}
     */
    public function connect(Application $app)
    {
        // creates a new controller based on the default route
        $controllers = $app['controllers_factory'];

        $controllers->get('/', function (Request $request) use ($app)
        {
            $menu = $app['config']->get('vd_menu');
            foreach ($menu['items'] as $name => $options)
            {
                if (isset($options['countQuery']))
                {
                    $menu['items'][$name]['count'] = call_user_func($options['countQuery']);
                }
                else
                {
                    $menu['items'][$name]['count'] = null;
                }
            }

            return $app['twig']->render('Menu/principal.twig', array(
                'menu'         => $menu,
                'currentRoute' => $request->get('currentRoute')
            ));
        })
        ->bind('menu_principal');

        $controllers->get('/destinations', function () use ($app)
        {
            $maxAge = 1200;

            $searchForm = $app['form.factory']->create(new AutocompleteType($app));

            $view = $app['twig']->render('Menu/destinations.twig', array(
                'searchForm'                => $searchForm->createView(),
                'etabByAlphabeticalOrder'   => $this->getEtablissementByAlphabeticalOrder($app),
                'regionsByDestinations'     => $this->getRegionsByDestinations($app),
                'regionEspagne'             => $this->getRegionByCode($app, 'ESP'),
                'regionItalie'              => $this->getRegionByCode($app, 'ITA'),
            ));

            return new Response($view, 200, array('Cache-Control' => sprintf('s-maxage=%s, public', $maxAge)));
        })
        ->bind('menu_destinations');

        $controllers->get('/locations', function () use ($app)
        {
            $maxAge = 1200;

            $locale = $app['context']->get('language');

            $categoryTypeHebergements = \Cungfoo\Model\CategoryTypeHebergementQuery::create()
                ->joinWithI18n($locale)
                ->orderBySortableRank()
                ->findActive()
            ;

            $capacites = \Cungfoo\Model\TypeHebergementCapaciteQuery::create()
                ->joinWithI18n($locale)
                ->orderBySortableRank()
                ->limit(4)
                ->findActive()
            ;

            $view = $app['twig']->render('Menu/locations.twig', array(
                'categoryTypeHebergements' => $categoryTypeHebergements,
                'capacites'                => $capacites,
            ));

            return new Response($view, 200, array('Cache-Control' => sprintf('s-maxage=%s, public', $maxAge)));
        })
        ->bind('menu_locations');

        $controllers->get('/bons-plans', function () use ($app)
        {
            $maxAge = 0;

            $categories = BonPlanCategorieQuery::create()
                ->distinct()
                ->addAscendingOrderByColumn('sortable_rank')
                ->useBonPlanBonPlanCategorieQuery()
                    ->filterByBonPlanId(null, Criteria::ISNOTNULL)
                ->endUse()
                ->findActive()
            ;

            $view = $app['twig']->render('Menu/bonsPlans.twig', array(
                'categories'    => $categories,
            ));

            return new Response($view, 200, array('Cache-Control' => sprintf('s-maxage=%s, public', $maxAge)));
        })
        ->bind('menu_bons_plans');

        $controllers->get('/vacances', function () use ($app)
        {
            return $app['twig']->render('Menu/vacances.twig');
        })
        ->bind('menu_vacances');

        $controllers->get('/weekends', function () use ($app)
        {
            return $app['twig']->render('Menu/weekends.twig');
        })
        ->bind('menu_weekends');

        return $controllers;
    }

    /**
     * @param null|\PropelPDO $con
     * @return array
     */
    protected function getEtablissementByAlphabeticalOrder(Application $app, \PropelPDO $con = null)
    {
        $etabs = EtablissementPeer::getNameOrderByName($app['context']->get('language'), $con);

        $etabByAlphabeticalOrder = array();
        foreach ($etabs as $etab)
        {
            $etabByAlphabeticalOrder[strtoupper(substr($etab->getName(), 0, 1))][] = $etab;
        }

        return $etabByAlphabeticalOrder;
    }

    public function getRegionsByDestinations(Application $app)
    {
        $locale = $app['context']->get('language');

        return DestinationQuery::create()
            ->orderBySortableRank()
            ->joinWithI18n($locale)
            ->joinWithRegion()
            ->useRegionQuery()
                ->useI18nQuery($locale)
                    ->orderByName()
                ->endUse()
                ->joinWithPays()
                ->usePaysQuery()
                    ->joinWithI18n($locale)
                ->endUse()
            ->endUse()
            ->findActive()
        ;
    }

    public function getRegionByCode(Application $app, $code)
    {
        $locale = $app['context']->get('language');

        return RegionQuery::create()
            ->useI18nQuery($locale)
                ->orderByName()
            ->endUse()
            ->joinWithPays()
            ->usePaysQuery()
                ->filterByCode($code)
                ->joinWithI18n($locale)
            ->endUse()
            ->findActive()
        ;
    }
}

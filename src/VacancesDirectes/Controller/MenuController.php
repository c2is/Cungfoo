<?php

namespace VacancesDirectes\Controller;

use Silex\Application,
    Silex\ControllerCollection,
    Silex\ControllerProviderInterface;

use Symfony\Component\HttpFoundation\Request,
    Symfony\Component\HttpKernel\Exception\NotFoundHttpException,
    Symfony\Component\Routing\Route;

use Cungfoo\Model\EtablissementPeer;

use VacancesDirectes\Form\Type\Destination\AutocompleteType;

class MenuController implements ControllerProviderInterface
{
    /**
     * {@inheritdoc}
     */
    public function connect(Application $app)
    {
        // creates a new controller based on the default route
        $controllers = $app['controllers_factory'];

        $controllers->get('/destinations', function () use ($app)
        {
            $searchForm = $app['form.factory']->create(new AutocompleteType($app));

            return $app['twig']->render('Menu/destinations.twig', array(
                'searchForm'                => $searchForm->createView(),
                'etabByAlphabeticalOrder'   => $this->getEtablissementByAlphabeticalOrder(),
                'etabByVilleOrder'          => $this->getEtablissementByVilleOrder($app['context']->get('language')),
                'regionsByDestinations'     => $this->getRegionsByDestinations($app['context']->get('language')),
                'regionEspagne' => $this->getRegionEspagne($app['context']->get('language')),
                'regionItalie' => $this->getRegionItalie($app['context']->get('language')),
                'regionPortugal' => $this->getRegionPortugal($app['context']->get('language')),
            ));
        })
        ->bind('menu_destinations');

        $controllers->get('/locations', function () use ($app)
        {
            return $app['twig']->render('Menu/locations.twig');
        })
        ->bind('menu_locations');

        $controllers->get('/bons-plans', function () use ($app)
        {
            return $app['twig']->render('Menu/bonsPlans.twig');
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
    protected function getEtablissementByAlphabeticalOrder(\PropelPDO $con = null)
    {
        $etabs = EtablissementPeer::getNameOrderByName($con);

        $etabByAlphabeticalOrder = array();
        foreach ($etabs as $etab)
        {
            $etabByAlphabeticalOrder[strtoupper(substr($etab['Name'], 0, 1))][] = $etab;
        }

        return $etabByAlphabeticalOrder;
    }

    /**
     * @param string $locale
     * @param null|\PropelPDO $con
     * @return array
     */
    protected function getEtablissementByVilleOrder($locale = BaseEtablissementPeer::DEFAULT_LOCALE, \PropelPDO $con = null)
    {
        $etabs = EtablissementPeer::getNameOrderByVille($locale, $con);

        $etabByAlphabeticalOrder = array();
        foreach ($etabs as $etab)
        {
            $etabByAlphabeticalOrder[$etab['Region.Id']]['Name'] = $etab['RegionI18n.Name'];
            $etabByAlphabeticalOrder[$etab['Region.Id']]['Villes'][$etab['Ville.Id']]['Name'] = $etab['VilleI18n.Name'];
            $etabByAlphabeticalOrder[$etab['Region.Id']]['Villes'][$etab['Ville.Id']]['Etabs'][] = $etab;
        }

        return $etabByAlphabeticalOrder;
    }

    public function getRegionsByDestinations($locale = BaseRegionPeer::DEFAULT_LOCALE, \PropelPDO $con = null)
    {
        $results = array();
        $destinations = array(
            '4' => array(
                'label'     => 'destination.mediterranee',
                'regions'   => array('LOCH', 'CBRA', 'NORM'),
            ),
            '3' => array(
                'label'     => 'destination.atlantique',
                'regions'   => array('ARDE'),
            ),
            '1' => array(
                'label'     => 'destination.montagne',
                'regions'   => array('NORM', 'CBRA'),
            ),
            '2' => array(
                'label'     => 'destination.campagne',
                'regions'   => array('VEND', 'BRET'),
            ),
        );

        foreach ($destinations as $destinationId => $destination)
        {
            $results[$destinationId] = array(
                'label'     => $destination['label'],
                'regions'   => array(),
            );

            foreach ($destination['regions'] as $region)
            {
                $results[$destinationId]['regions'][] = \Cungfoo\Model\RegionQuery::create()
                    ->filterByCode($region)
                    ->joinWithI18n($locale)
                    ->findOne()
                ;
            }
        }

        return $results;
    }

    public function getRegionEspagne($locale = BaseEtablissementPeer::DEFAULT_LOCALE){
        $results = array();

        $arrayRegion = array('CTBR', 'CBRA', 'CAZA', 'CDOR');

        $results = $this->getRegionsByForeignCountries($locale,null,$arrayRegion);

        return $results;
    }

    public function getRegionItalie($locale = BaseEtablissementPeer::DEFAULT_LOCALE){
        $results = array();

        $arrayRegion = array('IADR', 'IMED');

        $results = $this->getRegionsByForeignCountries($locale,null,$arrayRegion);

        return $results;
    }

    public function getRegionPortugal($locale = BaseEtablissementPeer::DEFAULT_LOCALE){
        $results = array();

        $arrayRegion = array('CTRO');

        $results = $this->getRegionsByForeignCountries($locale,null,$arrayRegion);

        return $results;
    }

    public function getRegionsByForeignCountries($locale = BaseEtablissementPeer::DEFAULT_LOCALE, \PropelPDO $con = null, $arrayRegion)
    {
        $results = array();

        foreach ($arrayRegion as $region)
        {
            $results[] = \Cungfoo\Model\RegionQuery::create()
                ->filterByCode($region)
                ->joinWithI18n($locale)
                ->findOne()
            ;
        }

        return $results;
    }
}

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
                'regionsByDestinations'     => $this->getRegionsByDestinations($app['context']->get('language')),
                'regionEspagne'             => $this->getRegionEspagne($app['context']->get('language')),
                'regionItalie'              => $this->getRegionItalie($app['context']->get('language')),
                'regionPortugal'            => $this->getRegionPortugal($app['context']->get('language')),
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
            $etabByAlphabeticalOrder[strtoupper(substr($etab->getName(), 0, 1))][] = $etab;
        }

        return $etabByAlphabeticalOrder;
    }

    public function getRegionsByDestinations($locale = BaseRegionPeer::DEFAULT_LOCALE, \PropelPDO $con = null)
    {
        $results = array();
        $destinations = array(
            '4' => array(
                'label'     => 'destination.mediterranee',
                'regions'   => array('LARO', 'PCA', 'CORS', 'HERA', 'AUDE', 'PYRO'),
            ),
            '3' => array(
                'label'     => 'destination.manche_atlantique',
                'regions'   => array('NORM', 'BRET', 'CHMA', 'PBAS', 'PLOI', 'VEND', 'GIRO', 'AQUI', 'PASD'),
            ),
            '1' => array(
                'label'     => 'destination.montagne',
                'regions'   => array('ARPY', 'ALP'),
            ),
            '2' => array(
                'label'     => 'destination.campagne',
                'regions'   => array('GERS', 'AUVE', 'AVEY', 'ARDE', 'LOCH', 'DRHP', 'VERD', 'PEDO', 'ALJU', 'LIM', 'TAR', 'ILE'),
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

        $arrayRegion = array('CAZA', 'CTBR', 'CBRA', 'CDOR', 'BLAC');

        $results = $this->getRegionsByForeignCountries($locale, null, $arrayRegion);

        return $results;
    }

    public function getRegionItalie($locale = BaseEtablissementPeer::DEFAULT_LOCALE){
        $results = array();

        $arrayRegion = array('IMED', 'TOSC', 'IADR');

        $results = $this->getRegionsByForeignCountries($locale, null, $arrayRegion);

        return $results;
    }

    public function getRegionPortugal($locale = BaseEtablissementPeer::DEFAULT_LOCALE){
        $results = array();

        $arrayRegion = array('CTRO');

        $results = $this->getRegionsByForeignCountries($locale, null, $arrayRegion);

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

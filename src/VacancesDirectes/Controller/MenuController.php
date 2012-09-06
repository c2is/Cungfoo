<?php

namespace VacancesDirectes\Controller;

use Silex\Application,
    Silex\ControllerCollection,
    Silex\ControllerProviderInterface;

use Symfony\Component\HttpFoundation\Request,
    Symfony\Component\HttpKernel\Exception\NotFoundHttpException,
    Symfony\Component\Routing\Route;

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
            return $app['twig']->render('Menu/destinations.twig', array(
                'etabByAlphabeticalOrder'   => $this->getEtablissementByAlphabeticalOrder(),
                'etabByVilleOrder'          => $this->getEtablissementByVilleOrder($app['context']->get('language')),
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
        $etabs = \Cungfoo\Model\EtablissementPeer::getNameOrderByName($con);

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
        $etabs = \Cungfoo\Model\EtablissementPeer::getNameOrderByVille($locale, $con);

        $etabByAlphabeticalOrder = array();
        foreach ($etabs as $etab)
        {
            $etabByAlphabeticalOrder[$etab['VilleI18n.Name']][] = $etab;
        }

        return $etabByAlphabeticalOrder;
    }
}

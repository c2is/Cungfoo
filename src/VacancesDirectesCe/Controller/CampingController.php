<?php

namespace VacancesDirectesCe\Controller;

use Silex\Application,
    Silex\ControllerCollection,
    Silex\ControllerProviderInterface;

use Symfony\Component\HttpFoundation\Request,
    Symfony\Component\HttpKernel\Exception\NotFoundHttpException,
    Symfony\Component\HttpFoundation\Response,
    Symfony\Component\Routing\Route;

class CampingController implements ControllerProviderInterface
{
    /**
     * {@inheritdoc}
     */
    public function connect(Application $app)
    {
        $controllers = $app['controllers_factory'];

        $controllers->match('/{idResalys}', function ($idResalys) use ($app)
        {
            $locale = $app['context']->get('language');

            $etab = \Cungfoo\Model\EtablissementQuery::create()
                ->joinWithI18n($locale)
                ->filterByCode($idResalys)
                ->findOne()
            ;

            $nbSiteAVisiter = \Cungfoo\Model\PointInteretQuery::create()
                ->useEtablissementPointInteretQuery()
                    ->filterByEtablissementId($etab->getId())
                ->endUse()
                ->count()
            ;

            $nbActivitesSportives = \Cungfoo\Model\EventQuery::create()
                ->useEtablissementEventQuery()
                    ->filterByEtablissementId($etab->getId())
                ->endUse()
                ->filterByCategory(\Cungfoo\Model\EventPeer::CATEGORY_SPORTIVE)
                ->count()
            ;

            $nbEvenementsCulturels = \Cungfoo\Model\EventQuery::create()
                ->useEtablissementEventQuery()
                    ->filterByEtablissementId($etab->getId())
                ->endUse()
                ->filterByCategory(\Cungfoo\Model\EventPeer::CATEGORY_SPORTIVE, \Criteria::NOT_EQUAL)
                ->count()
            ;

            $eventPrioritaire = \Cungfoo\Model\EventQuery::create()
                ->useEtablissementEventQuery()
                    ->filterByEtablissementId($etab->getId())
                ->endUse()
                ->orderByPriority(\Criteria::ASC)
                ->findOne()
            ;

            $personnages = \Cungfoo\Model\PersonnageQuery::create()
                ->joinWithI18n($locale)
                ->filterByEtablissementId($etab->getId())
                ->limit(3)
                ->find()
            ;

            return $app['twig']->render('Camping/camping.twig', array(
                'locale'                => $locale,
                'etab'                  => $etab,
                'nbSiteAVisiter'        => $nbSiteAVisiter,
                'nbActivitesSportives'  => $nbActivitesSportives,
                'nbEvenementsCulturels' => $nbEvenementsCulturels,
                'eventPrioritaire'      => $eventPrioritaire,
                'personnages'           => $personnages
            ));
        })
        ->bind('popin_camping');

        return $controllers;
    }
}

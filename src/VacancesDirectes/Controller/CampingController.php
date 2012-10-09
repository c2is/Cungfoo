<?php

namespace VacancesDirectes\Controller;

use Silex\Application,
    Silex\ControllerCollection,
    Silex\ControllerProviderInterface;

use Symfony\Component\HttpFoundation\Request;

class CampingController implements ControllerProviderInterface
{
    /**
     * {@inheritdoc}
     */
    public function connect(Application $app)
    {
        $controllers = $app['controllers_factory'];

        $controllers->match('/{id}', function ($id) use ($app)
        {
            $locale = $app['context']->get('language');

            /** @var \Cungfoo\Model\Etablissement $etab  */
            $etab = \Cungfoo\Model\EtablissementQuery::create()
                ->joinWithI18n($locale)
                ->filterById($id)
                ->findOne()
            ;

            /** @var \Cungfoo\Model\PointInteret $nbSiteAVisiter */
            $nbSiteAVisiter = \Cungfoo\Model\PointInteretQuery::create()
                ->useEtablissementPointInteretQuery()
                    ->filterByEtablissementId($id)
                ->endUse()
                ->count()
            ;

            /** @var \Cungfoo\Model\Event $nbActivitesSportives */
            $nbActivitesSportives = \Cungfoo\Model\EventQuery::create()
                ->useEtablissementEventQuery()
                    ->filterByEtablissementId($id)
                ->endUse()
                ->filterByCategory(\Cungfoo\Model\EventPeer::CATEGORY_SPORTIVE)
                ->count()
            ;

            /** @var \Cungfoo\Model\Event $nbEvenementsCulturels */
            $nbEvenementsCulturels = \Cungfoo\Model\EventQuery::create()
                ->useEtablissementEventQuery()
                    ->filterByEtablissementId($id)
                ->endUse()
                ->filterByCategory(\Cungfoo\Model\EventPeer::CATEGORY_SPORTIVE, \Criteria::NOT_EQUAL)
                ->count()
            ;

            /** @var \Cungfoo\Model\Event $eventPrioritaire */
            $eventPrioritaire = \Cungfoo\Model\EventQuery::create()
                ->useEtablissementEventQuery()
                    ->filterByEtablissementId($id)
                ->endUse()
                ->orderByPriority(\Criteria::ASC)
                ->findOne()
            ;

            $personnages = \Cungfoo\Model\PersonnageQuery::create()
                ->joinWithI18n($locale)
                ->filterByEtablissementId($id)
                ->orderByAge(\Criteria::ASC)
                ->limit(3)
                ->find()
            ;

            $multimedia = \Cungfoo\Model\MultimediaEtablissementQuery::create()
                ->joinWithI18n($locale)
                ->filterByEtablissementId($id)
                ->find()
            ;

            $tags = \Cungfoo\Model\TagQuery::create()
                ->joinWithI18n($locale)
                ->find()
            ;

            return $app['twig']->render('etablissement.twig', array(
                'locale'                => $locale,
                'etab'                  => $etab,
                'nbSiteAVisiter'        => $nbSiteAVisiter,
                'nbActivitesSportives'  => $nbActivitesSportives,
                'nbEvenementsCulturels' => $nbEvenementsCulturels,
                'eventPrioritaire'      => $eventPrioritaire,
                'personnages'           => $personnages,
                'multimedia'           => $multimedia,
                'tags'           => $tags
            ));
        })
        ->bind('camping_index')
        ;

        return $controllers;
    }
}

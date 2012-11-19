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
    Cungfoo\Model\EventPeer;

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

            $etab = EtablissementQuery::create()
                ->joinWithI18n($locale)
                ->filterByCode($idResalys)
                ->findOne()
            ;

            $sitesAVisiter = PointInteretPeer::getForEtablissement($etab, PointInteretPeer::RANDOM_SORT, 4);
            $events        = EventPeer::getForEtablissement($etab, EventPeer::RANDOM_SORT, 4);

            $personnages = \Cungfoo\Model\PersonnageQuery::create()
                ->joinWithI18n($locale)
                ->filterByEtablissementId($etab->getId())
                ->orderByAge(\Criteria::ASC)
                ->limit(3)
                ->find()
            ;

            $multimedia = \Cungfoo\Model\MultimediaEtablissementQuery::create()
                ->joinWithI18n($locale)
                ->filterByEtablissementId($etab->getId())
                ->find()
            ;

            $tags = \Cungfoo\Model\TagQuery::create()
                ->joinWithI18n($locale)
                ->find()
            ;

            $personnageAleatoire = \Cungfoo\Model\PersonnageQuery::create()
                ->joinWithI18n($locale)
                ->filterByEtablissementId($etab->getId())
                ->addAscendingOrderByColumn('RAND()')
                ->findOne()
            ;

            return $app['twig']->render('Camping/camping.twig', array(
                'locale'                  => $locale,
                'etab'                    => $etab,
                'personnages'             => $personnages,
                'multimedia'              => $multimedia,
                'tags'                    => $tags,
                'personnageAleatoire'     => $personnageAleatoire,
                'sitesAVisiter'           => $sitesAVisiter,
                'events'                  => $events
            ));
        })
        ->bind('camping');

        $controllers->match('/infobox/{idResalys}', function ($idResalys) use ($app)
        {
            $locale = $app['context']->get('language');

            $etab = \Cungfoo\Model\EtablissementQuery::create()
                ->joinWithI18n($locale)
                ->filterByCode($idResalys)
                ->findOne()
            ;

            return $app['twig']->render('Camping/camping.infobox.twig', array(
                'etab' => $etab
            ));

        })->bind('infobox_camping');

        return $controllers;
    }
}

<?php

namespace VacancesDirectes\Controller;

use Symfony\Component\HttpFoundation\Request;

use Silex\Application,
    Silex\ControllerCollection,
    Silex\ControllerProviderInterface;

use Cungfoo\Model\Etablissement,
    Cungfoo\Model\EtablissementQuery,
    Cungfoo\Model\EtablissementPeer,
    Cungfoo\Model\Event;

use VacancesDirectes\Lib\Listing\CatalogueListing,
    VacancesDirectes\Lib\SearchEngine;

class FicheEventController implements ControllerProviderInterface
{
    /**
     * {@inheritdoc}
     */
    public function connect(Application $app)
    {
        $controllers = $app['controllers_factory'];

        $controllers->match('/{slug}/', function (Request $request, $slug) use ($app)
        {
            $dateData = new \VacancesDirectes\Form\Data\Search\DateData();

            $locale = $app['context']->get('language');

            // Formulaire de recherche
            $searchEngine = new SearchEngine($app, $request);
            $searchEngine->process($dateData);

            if ($searchEngine->getRedirect())
            {
                return $app->redirect($searchEngine->getRedirect());
            }

            $event = \Cungfoo\Model\EventQuery::create()
                ->useEventI18nQuery()
                    ->filterByLocale($locale)
                    ->filterBySlug($slug)
                ->endUse()
                ->findOne()
            ;

            $campings = $event->getEtablissements();
            $list = new CatalogueListing($app);
            $list
                ->setData($campings)
                ->setType(CatalogueListing::CATALOGUE)
            ;
            $listContent = $list->process();

            return $app->renderView('Event/detail.twig', array(
                'locale'            => $locale,
                'event'               => $event,
                'list'              => $listContent,
                'searchForm'        => $searchEngine->getView(),
            ));
        })
        ->bind('event');

        return $controllers;
    }
}

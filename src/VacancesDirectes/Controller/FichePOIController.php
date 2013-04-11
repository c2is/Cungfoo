<?php

namespace VacancesDirectes\Controller;

use Symfony\Component\HttpFoundation\Request;

use Silex\Application,
    Silex\ControllerCollection,
    Silex\ControllerProviderInterface;

use Cungfoo\Model\Etablissement,
    Cungfoo\Model\EtablissementQuery,
    Cungfoo\Model\EtablissementPeer,
    Cungfoo\Model\PointInteret;

use VacancesDirectes\Lib\Listing\CatalogueListing,
    VacancesDirectes\Lib\SearchEngine;

class FichePOIController implements ControllerProviderInterface
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

            $poi = \Cungfoo\Model\PointInteretQuery::create()
                ->useI18nQuery($locale)
                    ->filterBySlug($slug)
                ->endUse()
                ->findOne()
            ;

            if (!$poi) {
                return $app->redirect($app['url_generator']->generate('homepage'));
            }

            $campings = $poi->getEtablissements();

            $list = new CatalogueListing($app);
            $list
                ->setData($campings)
                ->setType(CatalogueListing::CATALOGUE)
            ;
            $listContent = $list->process();

            return $app->renderView('POI/detail.twig', array(
                'locale'     => $locale,
                'poi'        => $poi,
                'list'       => $listContent,
                'searchForm' => $searchEngine->getView(),
            ));
        })
        ->bind('poi');

        return $controllers;
    }
}

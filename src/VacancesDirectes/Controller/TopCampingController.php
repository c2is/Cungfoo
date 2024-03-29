<?php

namespace VacancesDirectes\Controller;

use Silex\Application,
    Silex\ControllerCollection,
    Silex\ControllerProviderInterface;

use Symfony\Component\HttpFoundation\Request,
    Symfony\Component\HttpKernel\Exception\NotFoundHttpException,
    Symfony\Component\Routing\Route;

use Cungfoo\Model\EtablissementQuery,
    Cungfoo\Model\PaysQuery,
    Cungfoo\Model\RegionQuery,
    Cungfoo\Model\VilleQuery,
    Cungfoo\Model\MetadataPeer;

use VacancesDirectes\Lib\Listing\CatalogueListing,
    VacancesDirectes\Lib\SearchEngine;

class TopCampingController
{
    public function indexAction(Request $request, Application $app)
    {
        $locale = $app['context']->get('language');

        // Formulaire de recherche
        $searchEngine = new SearchEngine($app, $request);
        $searchEngine->process();
        if ($searchEngine->getRedirect())
        {
            return $app->redirect($searchEngine->getRedirect());
        }

        $topCampings = \Cungfoo\Model\TopCampingQuery::create()
            ->addAscendingOrderByColumn('sortable_rank')
            ->useEtablissementQuery()
                ->useI18nQuery($locale)
                    ->filterByActiveLocale(true)
                ->endUse()
                ->filterByActive(true)
            ->endUse()
            ->findActive()
        ;

        $etabs = array();
        foreach ($topCampings as $topCamping)
        {
            $etabs[] = $topCamping->getEtablissement();
        }

        // Création de la liste
        $list = new CatalogueListing($app);
        $list
            ->setData($etabs)
            ->setType(CatalogueListing::CATALOGUE)
        ;

        $listingContent = $list->process();

        return $app->renderView('Research\dispo.twig', array(
            'title'           => MetadataPeer::get('top_camping', 'seo_title'),
            'metaDescription' => MetadataPeer::get('top_camping', 'seo_description'),
            'h1' => $app->trans('topCamping.h1'),
            'list'       => $listingContent,
            'firstEtab'  => reset($listingContent['element']),
            'searchForm' => $searchEngine->getView(),
        ));
    }
}

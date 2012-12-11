<?php

namespace VacancesDirectes\Controller;

use Symfony\Component\HttpFoundation\Request;

use Silex\Application,
    Silex\ControllerCollection,
    Silex\ControllerProviderInterface;

use Cungfoo\Model\Etablissement,
    Cungfoo\Model\EtablissementQuery,
    Cungfoo\Model\EtablissementPeer,
    Cungfoo\Model\Theme;

use VacancesDirectes\Lib\Listing\CatalogueListing,
    VacancesDirectes\Lib\SearchEngine;

class VosWeekEndsController implements ControllerProviderInterface
{
    /**
     * {@inheritdoc}
     */
    public function connect(Application $app)
    {
        $controllers = $app['controllers_factory'];

        $controllers->match('/camping-{slug}/', function (Request $request, $slug) use ($app)
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

            $theme = \Cungfoo\Model\ThemeQuery::create()
                ->joinWithI18n($locale)
                ->useThemeI18nQuery()
                    ->filterBySlug($slug)
                ->endUse()
                ->findOne()
            ;

            $autresTheme = \Cungfoo\Model\ThemeQuery::create()
                ->joinWithI18n($locale)
                ->filterById($theme->getId(), \Criteria::NOT_EQUAL)
                ->addAscendingOrderByColumn('RAND()')
                ->findActive()
            ;

            $campings = $theme->getEtablissementsCatalogues();

            $list = new CatalogueListing($app);
            $list
                ->setData($campings)
                ->setType(CatalogueListing::CATALOGUE)
            ;
            $listContent = $list->process();

            return $app->renderView('VosWeekEnds/detail.twig', array(
                'locale'            => $locale,
                'theme'             => $theme,
                'autresTheme'       => $autresTheme,
                'list'              => $listContent,
                'searchForm'        => $searchEngine->getView(),
            ));
        })
        ->bind('vos_week_ends');

        return $controllers;
    }
}

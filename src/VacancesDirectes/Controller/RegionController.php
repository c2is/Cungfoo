<?php

namespace VacancesDirectes\Controller;

use Silex\Application,
    Silex\ControllerCollection,
    Silex\ControllerProviderInterface;

use Symfony\Component\HttpFoundation\Request,
    Symfony\Component\HttpKernel\Exception\NotFoundHttpException,
    Symfony\Component\Routing\Route;

use Cungfoo\Model\PaysQuery,
    Cungfoo\Model\RegionRefPeer;

use VacancesDirectes\Lib\Listing\CatalogueListing,
    VacancesDirectes\Lib\SearchEngine;

class RegionController implements ControllerProviderInterface
{
    /**
     * {@inheritdoc}
     */
    public function connect(Application $app)
    {
        $ctl = $app['controllers_factory'];

        $ctl->match('/', array($this, 'region'))
            ->bind('destination_region_list')
        ;

        return $ctl;
    }

    function region(Application $app, Request $request) {

        $searchEngine = new SearchEngine($app, $request);
        $searchEngine->process();
        if ($searchEngine->getRedirect())
        {
            return $app->redirect($searchEngine->getRedirect());
        }

        $pays = PaysQuery::create()
            ->findActive()
        ;

        return $app->renderView('Destination/list_region.twig', array(
            'pays'       => $pays,
            'metadata'   => RegionRefPeer::getMetadata($app['context']->get('language')),
            'searchForm' => $searchEngine->getView(),
        ));
    }
}

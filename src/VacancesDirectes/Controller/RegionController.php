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

        $ctl->get('/', array($this, 'region'))
            ->bind('destination_region_ref')
        ;

        return $ctl;
    }

    function region(Application $app, Request $request) {

        $searchEngine = new SearchEngine($app, $request);
        $searchEngine->process();

        $pays = PaysQuery::create()
            ->findActive()
        ;

        return $app->renderView('Destination/region.twig', array(
            'pays'       => $pays,
            'searchForm' => $searchEngine->getView(),
            'metadata'   => RegionRefPeer::getMetadata(),
        ));
    }
}

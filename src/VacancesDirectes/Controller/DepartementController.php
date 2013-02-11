<?php

namespace VacancesDirectes\Controller;

use Silex\Application,
    Silex\ControllerCollection,
    Silex\ControllerProviderInterface;

use Symfony\Component\HttpFoundation\Request,
    Symfony\Component\HttpKernel\Exception\NotFoundHttpException,
    Symfony\Component\Routing\Route;

use Cungfoo\Model\PaysQuery,
    Cungfoo\Model\DepartementPeer;

use VacancesDirectes\Lib\Listing\CatalogueListing,
    VacancesDirectes\Lib\SearchEngine;

class DepartementController implements ControllerProviderInterface
{
    /**
     * {@inheritdoc}
     */
    public function connect(Application $app)
    {
        $ctl = $app['controllers_factory'];

        $ctl->get('/', array($this, 'departement'))
            ->bind('destination_departement_list')
        ;

        return $ctl;
    }

    function departement(Application $app, Request $request) {

        $searchEngine = new SearchEngine($app, $request);
        $searchEngine->process();

        $pays = PaysQuery::create()
            ->orderById()
            ->findActive()
        ;

        return $app->renderView('Destination/list_departement.twig', array(
            'pays'       => $pays,
            'searchForm' => $searchEngine->getView(),
            'metadata'   => DepartementPeer::getMetadata(),
        ));
    }
}

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

class SessionController implements ControllerProviderInterface
{
    /**
     * {@inheritdoc}
     */
    public function connect(Application $app)
    {
        $controllers = $app['controllers_factory'];

        $controllers->match('/proposal/', function (Request $request) use ($app)
        {
            $target         = $request->get('target');

            $postParameters = $request->request->all();
            $proposal       = unserialize(reset($postParameters));

            $app['session']->set('last_proposal', array('target' => $target, 'proposal' => $proposal));

            return $app->redirect($target);
        })
        ->bind('session_proposal');

        return $controllers;
    }
}

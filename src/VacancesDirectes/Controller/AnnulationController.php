<?php

namespace VacancesDirectes\Controller;

use Symfony\Component\HttpFoundation\Request;

use Silex\Application,
    Silex\ControllerCollection,
    Silex\ControllerProviderInterface;

use VacancesDirectes\Form\Type\Annulation\AnnulationType,
    VacancesDirectes\Form\Data\Annulation\AnnulationData,
    VacancesDirectes\Lib\SearchEngine;

class AnnulationController implements ControllerProviderInterface
{
    public function connect(Application $app)
    {
        $controllers = $app['controllers_factory'];

        $controllers->match('/', function (Request $request) use ($app) {
            $form = $app['form.factory']->create(new AnnulationType($app), new AnnulationData());

            // Formulaire de recherche
            $searchEngine = new SearchEngine($app, $request);
            $searchEngine->process();

            if ($searchEngine->getRedirect())
            {
                return $app->redirect($searchEngine->getRedirect());
            }

            return $app->renderView('Annulation/form.twig', array(
                'searchForm'     => $searchEngine->getView(),
                'annulationForm' => $form->createView(),
            ));
        })
        ->bind('formulaire_annulation');

        return $controllers;
    }
}
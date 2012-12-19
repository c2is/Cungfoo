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
            // Formulaire de recherche
            $searchEngine = new SearchEngine($app, $request);
            $searchEngine->process();

            if ($searchEngine->getRedirect())
            {
                return $app->redirect($searchEngine->getRedirect());
            }

            $form = $app['form.factory']->create(new AnnulationType($app), new AnnulationData());

            if ('POST' == $request->getMethod() && $this->request->request->has('annulationForm'))
            {
                $form->bindRequest($request);

                if($form->isValid()) {
                    // TODO : envoi mail, enregistrement en base
                }
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
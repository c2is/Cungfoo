<?php

namespace VacancesDirectesCe\Controller;

use Silex\Application,
    Silex\ControllerCollection,
    Silex\ControllerProviderInterface;

use Symfony\Component\HttpFoundation\Request,
    Symfony\Component\HttpKernel\Exception\NotFoundHttpException,
    Symfony\Component\HttpFoundation\Response,
    Symfony\Component\Routing\Route;

use VacancesDirectesCe\Form\Data\AchatLineaireData,
    VacancesDirectesCe\Form\Type\AchatLineaireType;

class AchatController implements ControllerProviderInterface
{
    /**
     * {@inheritdoc}
     */
    public function connect(Application $app)
    {
        // creates a new controller based on the default route
        $controllers = $app['controllers_factory'];

        $controllers->match('/packages.html', function (Request $request) use ($app)
        {
            /** AchatLineaire form */
            $dataForm = new AchatLineaireData();

            // set form if session search_parameters exist
            if ($app['session']->get('search_parameters'))
            {
                $searchParametersData = $app['session']->get('search_parameters');
                $dataForm->pays = $searchParametersData['pays'];
                $dataForm->region = $searchParametersData['region'];
                $dataForm->campings = explode(';', $searchParametersData['campings']);
                $dataForm->dateDebut = $searchParametersData['dateDebut'];
                $dataForm->dateFin = $searchParametersData['dateFin'];
            }

            $achatLineaireForm = $app['form.factory']->create(new AchatLineaireType($app), $dataForm);

            // form validation
            if ('POST' == $request->getMethod())
            {
                $achatLineaireForm->bind($request->get($achatLineaireForm->getName()));
                if ($achatLineaireForm->isValid())
                {
                    $achatLineaireParameters = $request->request->all()['AchatLineaire'];

                    $aDateDebut = explode('/', $achatLineaireParameters['dateDebut']);
                    $dateDebutDate    = new \DateTime(sprintf('%s/%s/%s', $aDateDebut[1], $aDateDebut[0], $aDateDebut[2]));
                    $dateDebutTimestamp = $dateDebutDate->getTimestamp();

                    $aDateFin = explode('/', $achatLineaireParameters['dateFin']);
                    $dateFinDate    = new \DateTime(sprintf('%s/%s/%s', $aDateFin[1], $aDateFin[0], $aDateFin[2]));
                    $dateFinTimestamp = $dateFinDate->getTimestamp();

                    $achatLineaireParameters['nbJours'] =round(($dateFinTimestamp - $dateDebutTimestamp) / 86400);

                    if (!empty($achatLineaireParameters['campings']))
                    {
                        $achatLineaireParameters['campings'] = implode(';', $achatLineaireParameters['campings']);
                    }
                    else
                    {
                        $achatLineaireParameters['campings'] = '';
                    }

                    // default parameters
                    $achatLineaireParameters['maxResults'] = 12;
                    $achatLineaireParameters['sortString'] = "Priority,StartDate,Etab,RoomType(2),ProductPriority";

                    unset($achatLineaireParameters['token']);

                    return $app->redirect($app['url_generator']->generate('achat_recherche', $achatLineaireParameters));
                }
            }

            return $app['twig']->render('Achat/packages.twig', array(
                'achatLineaireForm' => $achatLineaireForm->createView(),
            ));
        })
        ->bind('achat_packages');

        $controllers->match('/resultats-recherche.html', function (Request $request) use ($app)
        {
            $achatLineaire = $request->query->all();
            if (isset($achatLineaire['dateDebut']))
            {
                $app['session']->set('search_parameters', $achatLineaire);
            }
            else
            {
                $achatLineaire = $app['session']->get('search_parameters');

                // override default paramterers
                $postParameters = $request->request->all();
                $achatLineaire['maxResults'] = isset($postParameters['search_form_max_results']) ? $postParameters['search_form_max_results'] : 12;
                $achatLineaire['sortString'] = isset($postParameters['search_form_sort_string']) ? $postParameters['search_form_sort_string'] : "Priority,StartDate,Etab,RoomType(2),ProductPriority";
            }

            return $app['twig']->render('Achat/resultatsRecherche.twig', array(
                'achatLineaire' => $achatLineaire,
            ));
        })
        ->bind('achat_recherche');

        $controllers->match('/panier.html', function (Request $request) use ($app)
        {
            $queryParameters   = $request->query->all();
            $requestParameters = $request->request->all();

            $queryString = http_build_query(array_merge($requestParameters, array('from' => $queryParameters['from'])), '', '&');

            return $app['twig']->render('Achat/panier.twig', array('queryString' => $queryString));
        })
        ->bind('achat_panier');

        $controllers->match('/confirmation-reservation.html', function (Request $request) use ($app)
        {
            $queryString = http_build_query($request->request->all(), '', '&');

            return $app['twig']->render('Achat/confirmation.twig', array('queryString' => $queryString));
        })
        ->bind('achat_confirmation_reservation');

        return $controllers;
    }
}

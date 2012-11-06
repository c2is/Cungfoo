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

class ReservationController implements ControllerProviderInterface
{
    /**
     * {@inheritdoc}
     */
    public function connect(Application $app)
    {
        // creates a new controller based on the default route
        $controllers = $app['controllers_factory'];

        $controllers->match('/recherche.html', function (Request $request) use ($app)
        {
            /** AchatLineaire form */
            $dataForm = new AchatLineaireData();

            // set form if session search_parameters_reservation exist
            if ($app['session']->get('search_parameters_reservation'))
            {
                $searchParametersData = $app['session']->get('search_parameters_reservation');
                $dataForm->pays = $searchParametersData['pays'];
                $dataForm->region = $searchParametersData['region'];
                $dataForm->campings = explode(';', $searchParametersData['campings']);
                $dataForm->dateDebut = $searchParametersData['dateDebut'];
                $dataForm->dateFin = $searchParametersData['dateFin'];
                $dataForm->isBasseSaison = $searchParametersData['isBasseSaison'];
                $dataForm->nbAdultes = $searchParametersData['nbAdultes'];
                $dataForm->nbEnfants = $searchParametersData['nbEnfants'];
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
                    $achatLineaireParameters['search_page'] = 1;
                    $achatLineaireParameters['search_form_max_results'] = 12;
                    $achatLineaireParameters['search_form_sort_string'] = "Priority,StartDate,Etab,RoomType(2),ProductPriority";

                    unset($achatLineaireParameters['token']);

                    return $app->redirect($app['url_generator']->generate('reservation_disponibilites', $achatLineaireParameters));
                }
            }

            return $app['twig']->render('Modeles/Reservation/recherche.twig', array(
                'achatLineaireForm'  => $achatLineaireForm->createView(),
            ));
        })
        ->bind('reservation_recherche');

        $controllers->match('/disponibilites.html', function (Request $request) use ($app)
        {
            $achatLineaire = $request->query->all();
            if (isset($achatLineaire['dateDebut']))
            {
                $app['session']->set('search_parameters_reservation', $achatLineaire);
            }
            else
            {
                $achatLineaire = $app['session']->get('search_parameters_reservation');

                // override default paramterers
                $postParameters = $request->request->all();
                $achatLineaire['search_page'] = isset($postParameters['search_page']) ? $postParameters['search_page'] : 1;
                $achatLineaire['search_form_max_results'] = isset($postParameters['search_form_max_results']) ? $postParameters['search_form_max_results'] : 12;
                $achatLineaire['search_form_sort_string'] = isset($postParameters['search_form_sort_string']) ? $postParameters['search_form_sort_string'] : "Priority,StartDate,Etab,RoomType(2),ProductPriority";
            }

            return $app['twig']->render('Modeles/Reservation/disponibilites.twig', array(
                'achatLineaire' => $achatLineaire,
                'webUserReservation'  => 'web_ce_cpc_fr'
            ));
        })
        ->bind('reservation_disponibilites');

        $controllers->match('/options.html', function (Request $request) use ($app)
        {
            $queryParameters   = $request->query->all();
            $requestParameters = $request->request->all();

            $queryString = http_build_query($requestParameters, '', '&');

            return $app['twig']->render('Modeles/options.twig', array('queryString' => $queryString));
        })
        ->bind('reservation_options');

        $controllers->match('/panier.html', function (Request $request) use ($app)
        {
            $queryParameters   = $request->query->all();
            $requestParameters = $request->request->all();

            $queryString = http_build_query(array_merge($requestParameters, array('from' => $queryParameters['from'])), '', '&');

            return $app['twig']->render('Modeles/panier.twig', array('queryString' => $queryString));
        })
        ->bind('reservation_panier');

        $controllers->match('/confirmation.html', function (Request $request) use ($app)
        {
            $queryString = http_build_query($request->request->all(), '', '&');

            return $app['twig']->render('Modeles/confirmation.twig', array('queryString' => $queryString));
        })
        ->bind('reservation_confirmation');

        return $controllers;
    }

    public function getAlreadyClassique(Application $app)
    {
        try
        {
            $url = sprintf("%s?webuser=web_ce_achat_fr&display=customer_area&tokens=ignore_token&session=%s&customer_area_sub_page=has_lineaire",
                $app['url_generator']->generate('resalys_wrapper', array(), true),
                $app['session']->get('resalys_user')->session
            );

            return trim(file_get_contents($url)) == 1;
        }
        catch (\Exception $e)
        {
            return false;
        }
    }
}

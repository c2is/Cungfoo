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
            $queryString = http_build_query($request->request->all(), '', '&');

            // array(6) { ["pays"]=> string(1) "1" ["region"]=> string(1) "1" ["dateDebut"]=> string(10) "01/07/2012" ["dateFin"]=> string(10) "31/08/2012" ["nbAdultes"]=> string(1) "1" ["_token"]=> string(40) "5cac746b36845442f3ac0b7c63c852a4218e5c4d" }

            return $app['twig']->render('Achat/resultatsRecherche.twig', array(
                'queryString'   => $queryString,
                'achatLineaire' => $request->query->all(),
            ));
        })
        ->bind('achat_recherche');

        $controllers->match('/panier.html', function (Request $request) use ($app)
        {
            $queryString = http_build_query($request->request->all(), '', '&');

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

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

class RequestController implements ControllerProviderInterface
{
    /**
     * {@inheritdoc}
     */
    public function connect(Application $app)
    {
        // creates a new controller based on the default route
        $controllers = $app['controllers_factory'];

        $controllers->match('/identifiant.html', function (Request $request) use ($app)
        {
            if ('POST' == $request->getMethod())
            {
                $query = $request->request->all();
            }
            else
            {
                $query = array(
                    'webuser' => 'web_ce_achat_fr',
                    'display' => 'forget_login',
                    'template' => 'search_product_results',
                    'actions' => 'displayForgetLoginForm',
                    'criterias_object_name' => 'search_form',
                    'search_page' => '1',
                    'page_after_auth' => '',
                );
            }

            return $app['twig']->render('Request/identifiant.twig', array('query' => $query));
        })->bind('request_identifiant');

        $controllers->match('/mot-de-passe.html', function (Request $request) use ($app)
        {
            if ('POST' == $request->getMethod())
            {
                $query = $request->request->all();
            }
            else
            {
                $query = array(
                    'webuser' => 'web_ce_achat_fr',
                    'display' => 'forget_password',
                    'template' => 'search_product_results',
                    'actions' => 'displayForgetPasswordForm',
                    'criterias_object_name' => 'search_form',
                    'search_page' => '1',
                    'page_after_auth' => '',
                );
            }

            return $app['twig']->render('Request/motDePasse.twig', array('query' => $query));
        })->bind('request_password');

        return $controllers;
    }
}

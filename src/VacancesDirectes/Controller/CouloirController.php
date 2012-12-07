<?php

namespace VacancesDirectes\Controller;

use Silex\Application,
    Silex\ControllerCollection,
    Silex\ControllerProviderInterface;

use Symfony\Component\HttpFoundation\Request,
    Symfony\Component\HttpKernel\Exception\NotFoundHttpException,
    Symfony\Component\Routing\Route;

use Cungfoo\Model\EtablissementQuery,
    Cungfoo\Model\VilleQuery;

use VacancesDirectes\Lib\SearchEngine,
    VacancesDirectes\Lib\SearchParams,
    VacancesDirectes\Lib\Listing\DispoListing;

use Resalys\Lib\Client\DisponibiliteClient;

class CouloirController implements ControllerProviderInterface
{
    public function connect(Application $app)
    {
        $controllers = $app['controllers_factory'];

        $controllers->match('/detail-sejour/{proposalKey}', function (Request $request, $proposalKey) use ($app) {
            $query = array(
                "specificFiles"     => 'couloir',
                "base_id"           => 'vacancesdirectes_preprod_v6_6',
                "webuser"           => 'web_fr',
                "tokens"            => 'ignore_token',
                "display"           => 'reservation_content',
                "actions"           => 'cancelReservation;buildProposalFromKey;chooseProposal',
                "proposal_key"      => $proposalKey,
                "referer"           => $request->headers->get('referer')
            );

            $query = array_merge($query, $request->request->all());

            return $app['twig']->render('Couloir\detail-sejour.twig', array(
                'query' => $query,
                "step"  => 1,
            ));
        })
        ->value('proposalKey', null)
        ->bind('couloir_detail_sejour');

        $controllers->post('/recapitulatif/{proposalKey}', function (Request $request, $proposalKey) use ($app) {
            $query = array(
                "specificFiles"     => 'couloir',
                "base_id"           => 'vacancesdirectes_preprod_v6_6',
                "webuser"           => 'web_fr',
                "tokens"            => 'ignore_token',
                "display"           => 'cart_payment',
                "actions"           => 'updateReservationContent;BupdateReservationAddPrestations;BupdateCartReservations',
                "proposal_key"      => $proposalKey,
                "confirmation"      => $app['url_generator']->generate('couloir_confirmation', array(), true),
                "homeLink"          => $app['url_generator']->generate('homepage', array(), true),
                "backLink"          => 'javascript:history.go(-1);'
            );

            $query = array_merge($query, $request->request->all());

            return $app['twig']->render('Couloir\detail-sejour.twig', array(
                'query' => $query,
                "step"  => 2,
            ));
        })
        ->value('proposalKey', null)
        ->bind('couloir_recapitulatif');


        $controllers->get('/confirmation', function (Request $request) use ($app) {
            $query = array(
                "specificFiles" => 'couloir',
                "base_id"       => 'vacancesdirectes_preprod_v6_6',
                "webuser"       => 'web_fr',
                "tokens"        => 'ignore_token',
                "display"       => 'cart_saved',
                "actions"       => $request->query->get('actions'),
                "session"       => $request->query->get('session'),
                "tokens"        => $request->query->get('tokens')
            );

            $query = array_merge($query, $request->request->all());

            return $app['twig']->render('Couloir\confirmation.twig', array(
                'query' => $query,
                "step"  => 4,
            ));
        })
        ->bind('couloir_confirmation');

        return $controllers;
    }
}

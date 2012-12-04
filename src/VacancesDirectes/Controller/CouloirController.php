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
            );

            $query = array_merge($query, $request->request->all());

            return $app['twig']->render('Couloir\detail-sejour.twig', array(
                'query' => $query,
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
                "backLink"          => 'javascript:history.go(-1);',
            );

            $query = array_merge($query, $request->request->all());

            return $app['twig']->render('Couloir\detail-sejour.twig', array(
                'query' => $query,
            ));
        })
        ->value('proposalKey', null)
        ->bind('couloir_recapitulatif');

        return $controllers;
    }
}

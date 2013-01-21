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

        $controllers->match('/' . $app->trans('seo.url.couloir.detail') . '/{proposalKey}', function (Request $request, $proposalKey) use ($app) {

            $rslConfig = $app['config']->get('rsl_config')['services']['disponibilite']['default_envelope'];

            $query = array(
                "specificFiles"     => 'couloir',
                "base_id"           => $rslConfig['base_id'],
                "webuser"           => $rslConfig['username'],
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

        $controllers->post('/' . $app->trans('seo.url.couloir.recapitulatif') . '/{proposalKey}', function (Request $request, $proposalKey) use ($app) {

            $rslConfig = $app['config']->get('rsl_config')['services']['disponibilite']['default_envelope'];

            $query = array(
                "specificFiles"     => 'couloir',
                "base_id"           => $rslConfig['base_id'],
                "webuser"           => $rslConfig['username'],
                "tokens"            => 'ignore_token',
                "display"           => 'cart_payment',
                "actions"           => 'updateReservationContent;BupdateReservationAddPrestations;BupdateCartReservations',
                "proposal_key"      => $proposalKey,
                "confirmation"      => $app['url_generator']->generate('couloir_confirmation', array(), true),
                "homeLink"          => $app['url_generator']->generate('homepage', array(), true),
                "backLink"          => 'javascript:history.go(-1);',
                "cgv"               => $app['url_generator']->generate('edito_by_slug', array('slug' => 'conditions-generales'), true)
            );

            $query = array_merge($query, $request->request->all());

            return $app['twig']->render('Couloir\detail-sejour.twig', array(
                'query' => $query,
                "step"  => 2,
            ));
        })
        ->value('proposalKey', null)
        ->bind('couloir_recapitulatif');


        $controllers->get('/' . $app->trans('seo.url.couloir.confirmation') . '', function (Request $request) use ($app) {

            $rslConfig = $app['config']->get('rsl_config')['services']['disponibilite']['default_envelope'];

            $query = array(
                "specificFiles" => 'couloir',
                "base_id"       => $rslConfig['base_id'],
                "webuser"       => $rslConfig['username'],
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

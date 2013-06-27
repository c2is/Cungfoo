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
    protected function getResalysConfig(Application $app)
    {
        $rslConfig = $app['config']->get('rsl_config')['services']['disponibilite']['default_envelope'];
        if (isset($app['config']->get('languages')[$app['context']->get('language')]) && isset($app['config']->get('languages')[$app['context']->get('language')]['resalys_username']))
        {
            $rslConfig['username'] = $app['config']->get('languages')[$app['context']->get('language')]['resalys_username'];
        }

        return $rslConfig;
    }

    protected function pushCookieSession(Request $request, $options)
    {
        $session = base64_decode(str_replace('B64_', '', $request->cookies->get('session_name')));

        if (isset($options['session']) and $options['session'] and $options['session'] != $session)
        {
            $request->cookies->remove('session_name');
            setcookie("session_name", 'B64_'.base64_encode($options['session']), time() + 900);
            $session = $options['session'];
        }

        $options['session'] = $session;

        return $options;
    }

    public function connect(Application $app)
    {
        $controllers = $app['controllers_factory'];

        $controllers->match('/' . $app->trans('seo.url.couloir.detail') . '/{proposalKey}', function (Request $request, $proposalKey) use ($app) {

            $rslConfig = $this->getResalysConfig($app);

            $query = array(
                "specificFiles" => 'couloir',
                "base_id"       => $rslConfig['base_id'],
                "webuser"       => $rslConfig['username'],
                "tokens"        => 'ignore_token',
                "display"       => 'reservation_content',
                "actions"       => 'cancelReservation;buildProposalFromKey;chooseProposal',
                "proposal_key"  => $proposalKey,
                "referer"       => $request->headers->get('referer'),
            );

            $query = array_merge($query, $request->request->all());

            $query = $this->pushCookieSession($request, $query);

            return $app->renderView('Couloir\detail-sejour.twig', array(
                'query' => $query,
                "step"  => 1,
            ));
        })
        ->value('proposalKey', null)
        ->bind('couloir_detail_sejour');

        $controllers->match('/' . $app->trans('seo.url.couloir.recapitulatif') . '/{proposalKey}', function (Request $request, $proposalKey) use ($app) {

            $rslConfig = $this->getResalysConfig($app);

            $query = array(
                "specificFiles" => 'couloir',
                "base_id"       => $rslConfig['base_id'],
                "webuser"       => $rslConfig['username'],
                "tokens"        => 'ignore_token',
                "display"       => 'cart_payment',
                "actions"       => 'updateReservationContent;BupdateReservationAddPrestations;BupdateCartReservations',
                "proposal_key"  => $proposalKey,
                "confirmation"  => $app['url_generator']->generate('couloir_confirmation', array(), true),
                "homeLink"      => $app['url_generator']->generate('homepage', array(), true),
                "backLink"      => 'javascript:history.go(-1);',
                "cgv"           => $app['url_generator']->generate('edito_by_slug', array('slug' => 'conditions-generales'), true),
                "session"       => base64_decode(str_replace('B64_', '', $request->cookies->get('session_name'))),
            );

            $query = array_merge($query, $request->request->all());

            $query = $this->pushCookieSession($request, $query);

            return $app->renderView('Couloir\detail-sejour.twig', array(
                'query' => $query,
                "step"  => 2,
            ));
        })
        ->value('proposalKey', null)
        ->bind('couloir_recapitulatif');


        $controllers->get('/' . $app->trans('seo.url.couloir.confirmation') . '', function (Request $request) use ($app) {

            $rslConfig = $this->getResalysConfig($app);

            $query = array(
                "specificFiles" => 'couloir',
                "base_id"       => $rslConfig['base_id'],
                "webuser"       => $rslConfig['username'],
                "tokens"        => 'ignore_token',
                "display"       => 'cart_saved',
                "actions"       => $request->query->get('actions'),
                "session"       => base64_decode(str_replace('B64_', '', $request->cookies->get('session_name'))),
                "tokens"        => $request->query->get('tokens')
            );

            $query = array_merge($query, $request->request->all());

            $query = $this->pushCookieSession($request, $query);

            $cookies = $request->cookies;
            if($cookies->has('tag_uci'))
            {
                $query['tag_uci'] = $cookies->get('tag_uci');
            }

            return $app->renderView('Couloir\confirmation.twig', array(
                'query' => $query,
                "step"  => 4,
            ));
        })
        ->bind('couloir_confirmation');

        return $controllers;
    }
}

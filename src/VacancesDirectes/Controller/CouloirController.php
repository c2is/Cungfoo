<?php

namespace VacancesDirectes\Controller;

use Silex\Application,
    Silex\ControllerCollection,
    Silex\ControllerProviderInterface;

use Symfony\Component\HttpFoundation\Request,
    Symfony\Component\HttpKernel\Exception\NotFoundHttpException,
	Symfony\Component\HttpFoundation\Response,
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
           //$request->cookies->remove('session_name');
           // setcookie("session_name", 'B64_'.base64_encode($options['session']), time() + 900);
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
				"session"       => base64_decode(str_replace('B64_', '', $request->cookies->get('session_name'))),
                "referer"       => $request->headers->get('referer'),
            );
			
			//echo base64_decode(str_replace('B64_', '', $request->cookies->get('session_name')));
            
			$query = array_merge($query, $request->request->all());

            $query = $this->pushCookieSession($request, $query);

            $view = $app['twig']->render('Couloir\detail-sejour.twig', array(
                'query' => $query,
                "step"  => 1,
            ));

			$response = new Response($view);

			$date = new \DateTime();
			$response->setExpires($date);

			return $response;
        })
        ->value('proposalKey', null)
        ->bind('couloir_detail_sejour');

        $controllers->match('/' . $app->trans('seo.url.couloir.recapitulatif') . '/{proposalKey}', function (Request $request, $proposalKey) use ($app) {
			
			$gateway_messages = array('LANG_ogone_canceled', 'LANG_ogone_declined');
								
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
                "backLink"      => 'history.go(-1);',
                "cgv"           => $app['url_generator']->generate('edito_by_slug', array('slug' => 'conditions-generales'), true),
                "session"       => base64_decode(str_replace('B64_', '', $request->cookies->get('session_name'))),
				"ogone_accepted_route" => '/'.$app->trans('seo.url.couloir.index').'/'.$app->trans('seo.url.couloir.confirmation'),
				"ogone_back_route" => '/'.$app->trans('seo.url.couloir.index').'/'.$app->trans('seo.url.couloir.recapitulatif'),
            );
			
			if(in_array($request->query->get('gateway_message'),$gateway_messages)) 
				$query['gateway_message'] = $request->query->get('gateway_message');

            $query = array_merge($query, $request->request->all());

            $query = $this->pushCookieSession($request, $query);

            $view = $app['twig']->render('Couloir\detail-sejour.twig', array(
                'query' => $query,
                "step"  => 2,
            ));

			$response = new Response($view);

			$date = new \DateTime();
			$response->setExpires($date);

			return $response;
        })
        ->value('proposalKey', null)
        ->bind('couloir_recapitulatif');


        $controllers->get('/' . $app->trans('seo.url.couloir.confirmation') . '', function (Request $request) use ($app) {

            $rslConfig = $this->getResalysConfig($app);
			
			$gateway_messages = array('LANG_ogone_exception', 'LANG_ogone_accepted');

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
			
			if(in_array($request->query->get('gateway_message'),$gateway_messages)) 
				$query['gateway_message'] = $request->query->get('gateway_message');
			
            $query = array_merge($query, $request->request->all());

            $query = $this->pushCookieSession($request, $query);

            $cookies = $request->cookies;
            if($cookies->has('tag_uci'))
            {
                $query['tag_uci'] = $cookies->get('tag_uci');
            }

            $view = $app['twig']->render('Couloir\confirmation.twig', array(
                'query' => $query,
                "step"  => 4,
            ));

			$response = new Response($view);

			$date = new \DateTime();
			$response->setExpires($date);

			return $response;
        })
        ->bind('couloir_confirmation');

        $controllers->get('/error', function (Request $request) use ($app) {
            var_dump(
                'Query ###',
                $request->query->all(),
                'Request ###',
                $request->request->all(),
                'Server ###',
                $request->server->all(),
                'Cookies ###',
                $request->cookies->all()
            );
            die;
        })
        ->bind('couloir_error');

        return $controllers;
    }
}

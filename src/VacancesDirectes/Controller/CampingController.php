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
    Cungfoo\Model\PointInteretPeer,
    Cungfoo\Model\EventPeer;

class CampingController implements ControllerProviderInterface
{
    /**
     * {@inheritdoc}
     */
    public function connect(Application $app)
    {
        $controllers = $app['controllers_factory'];

        $controllers->get('/list/item/{camping}', function (Request $request, $camping) use ($app)
        {
            $maxAge = 3600;

            $locale = $app['context']->get('language');

            $etab = \Cungfoo\Model\EtablissementQuery::create()
                ->joinWithI18n($locale)
                ->filterById($camping)
                ->findOne()
            ;

            $view = $app['twig']->render('Camping/list_item.twig', array(
                'list'    => array('type' => 0),
                'etab'    => array('model' => $etab),
				'nomEtab' => $app->trans('fiche.camping').' '.str_replace($app->trans('fiche.camping'),'',$etab->getName())
            ));

            return new Response($view, 200, array('Cache-Control' => sprintf('s-maxage=%s, public', $maxAge)));
        })->bind('camping_list_item');

        $controllers->match('/infobox/{idResalys}', function ($idResalys, $_route) use ($app)
        {
            $locale = $app['context']->get('language');

            $etab = \Cungfoo\Model\EtablissementQuery::create()
                ->joinWithI18n($locale)
                ->filterByCode($idResalys)
                ->findOne()
            ;

            return $app['twig']->render('Camping/camping.infobox.twig', array(
                'etab' => $etab
            ));

        })->bind('infobox_camping');

        return $controllers;
    }
}

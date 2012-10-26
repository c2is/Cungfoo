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

use Cungfoo\Model\EditoQuery;

class EditoController implements ControllerProviderInterface
{
    /**
     * {@inheritdoc}
     */
    public function connect(Application $app)
    {
        // creates a new controller based on the default route
        $controllers = $app['controllers_factory'];

        $controllers->match('/{slug}.html', function (Request $request, $slug) use ($app)
        {
            return $app['twig']->render('Edito/view.twig', array(
                'edito' => $this->getEditoBySlug($slug),
            ));
        })->bind('edito_by_slug');

        $controllers->match('/{id}', function (Request $request, $id) use ($app)
        {
            return $app['twig']->render('Edito/view.twig', array(
                'edito' => $this->getEditoById($id),
            ));
        })
        ->assert('id', '\d+')
        ->bind('edito_by_id');

        $controllers->match('/popin/{slug}.html', function (Request $request, $slug) use ($app)
        {
            return $app['twig']->render('Edito/view.popin.twig', array(
                'edito' => $this->getEditoBySlug($slug),
            ));
        })->bind('edito_popin_by_slug');

        $controllers->match('/popin/{id}', function (Request $request, $id) use ($app)
        {
            return $app['twig']->render('Edito/view.popin.twig', array(
                'edito' => $this->getEditoById($id),
            ));
        })
        ->assert('id', '\d+')
        ->bind('edito_popin_by_id');

        return $controllers;
    }

    public function getEditoBySlug($slug)
    {
        return EditoQuery::create()
            ->filterBySlug($slug)
            ->findOne()
        ;
    }

    public function getEditoById($id)
    {
        return EditoQuery::create()
            ->filterById($id)
            ->findOne()
        ;
    }
}

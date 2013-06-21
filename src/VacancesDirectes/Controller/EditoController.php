<?php

namespace VacancesDirectes\Controller;

use Silex\Application,
    Silex\ControllerCollection,
    Silex\ControllerProviderInterface;

use Symfony\Component\HttpFoundation\Request,
    Symfony\Component\HttpKernel\Exception\NotFoundHttpException,
    Symfony\Component\HttpFoundation\Response,
    Symfony\Component\Routing\Route;

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
            $locale = $app['context']->get('language');

            return $app->renderView('Edito/view.twig', array(
                'edito' => $this->getEditoBySlug($slug, $locale),
            ));
        })->bind('edito_by_slug');

        $controllers->match('/{id}', function (Request $request, $id) use ($app)
        {
            $locale = $app['context']->get('language');
            $edito  = $this->getEditoById($id, $locale);

            if (!$edito) {
                $app->abort(404);
            }

            return $app->renderView('Edito/view.twig', array(
                'edito' => $edito,
            ));
        })
        ->assert('id', '\d+')
        ->bind('edito_by_id');

        return $controllers;
    }

    public function getEditoBySlug($slug, $locale)
    {
        return EditoQuery::create()
            ->joinWithI18n($locale)
            ->filterBySlug($slug)
            ->findOne()
        ;
    }

    public function getEditoById($id, $locale)
    {
        return EditoQuery::create()
            ->joinWithI18n($locale)
            ->filterById($id)
            ->findOne()
        ;
    }
}

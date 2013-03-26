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
use VacancesDirectes\Controller\Component;

class EditoController implements ControllerProviderInterface
{
    /**
     * {@inheritdoc}
     */
    public function connect(Application $app)
    {
        $ctl = $app['controllers_factory'];

        $ctl->match('/{edito}.html', array($this, 'edito'))
            ->convert('edito', array($this, 'getEditoBySlug'))
            ->bind('edito_by_slug')
        ;

        $ctl->match('/{edito}', array($this, 'edito'))
            ->convert('edito', array($this, 'getEditoById'))
            ->assert('id', '\d+')
            ->bind('edito_by_id')
        ;

        return $ctl;
    }

    function getEditoBySlug($edito) {
        return EditoQuery::create()
            ->joinWithI18n()
            ->filterBySlug($edito)
            ->findOne()
        ;
    }

    function getEditoById($edito) {
        return EditoQuery::create()
            ->joinWithI18n()
            ->filterById($edito)
            ->findOne()
        ;
    }

    function edito(Application $app, Request $request, $edito) {
        if (!$edito) {
            $app->abort(404);
        }

        $template  = $edito->getEditoView()->getSource();
        $component = $this-> getComponent($edito, $app, $request);

        return $app->renderView(sprintf('Edito/%s', $template), array(
            'edito'     => $edito,
            'component' => $component,
        ));
    }

    function getComponent($edito, Application $app, Request $request) {
        if ($editoComponent = $edito->getEditoComponent()) {
            $editoComponentClass = $editoComponent->getAction();

            if ($editoComponentClass) {
                $componentClass = sprintf("\VacancesDirectes\Controller\Component\%s", $editoComponentClass);

                if (class_exists($componentClass)) {
                    return $componentClass::render($app, $request);
                }
            }
        }

        return null;
    }
}

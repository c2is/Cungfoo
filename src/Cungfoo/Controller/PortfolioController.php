<?php

namespace Cungfoo\Controller;

use Silex\Application,
Silex\ControllerCollection,
Silex\ControllerProviderInterface;

use Symfony\Component\HttpFoundation\Request,
Symfony\Component\HttpKernel\Exception\NotFoundHttpException,
Symfony\Component\Routing\Route;

class PortfolioController implements ControllerProviderInterface
{
    /**
     * {@inheritdoc}
     */
    public function connect(Application $app)
    {
        $controllers = $app['controllers_factory'];

        $controllers->get('/browse', function () use ($app)
        {
            require $app['config']->get('root_dir') . '/web/vendor/kcfinder/browse.php';
        })
        ->bind('portfolio_browse');

        $controllers->get('/upload', function ($id) use ($app)
        {

        })
        ->bind('portfolio_upload');

        return $controllers;
    }
}

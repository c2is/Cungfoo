<?php

/**
 * Définition des variables utilisé
 *
 * @var \Silex\Application $app
 */

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Loader\YamlFileLoader;

use Cungfoo\Lib\Crud\Router as CrudRouter;

$app->get('/', function () use ($app) {
    return $app['twig']->render('index.html', array());
})
->bind('homepage')
;

$app->error(function (\Exception $e, $code) use ($app) {
    if ($app['debug']) {
        return;
    }

    $page = 404 == $code ? '404.html' : '500.html';

    return new Response($app['twig']->render($page, array('code' => $code)), $code);
});

$crudRouter = new CrudRouter();
$crudRouter->load(sprintf('%s/config/Cungfoo/crud.yml', $app['config.root-dir']));
$crudController = $crudRouter->getController();

foreach ($crudRouter->getRoutes() as $name => $route)
{
    $app->mount($route['prefix'], new $crudController(
        $name, $route['model'], $route['form']
    ));
}
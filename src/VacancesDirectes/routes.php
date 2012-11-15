<?php
/**
 * Configuration of our application routing
 *
 * @author  Morgan Brunot <brunot.morgan@gmail.com>
 *          Denis Roussel <denis.roussel@gmail.com>
 *
 * @package Cungfoo by C2IS
 */

use Symfony\Component\HttpFoundation\Request,
    Symfony\Component\HttpFoundation\Response,
    Symfony\Component\HttpFoundation\JsonResponse,
    Symfony\Component\HttpFoundation\RedirectResponse,
    Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use Cungfoo\Lib\Crud\Router as CrudRouter;

use VacancesDirectes\Controller;

$app->mount('/',              new Controller\HomepageController());
$app->mount('/menu',          new Controller\MenuController());
$app->mount('/camping',       new Controller\CampingController());
$app->mount('/search_engine', new Controller\SearchEngineController());
$app->mount('/catalogue',     new Controller\CatalogueController());
$app->mount('/dispo',         new Controller\DispoController());

$app->error(function (\Exception $e, $code) use ($app) {
    if ($app['debug'])
    {
        return;
    }

    $page = 404 == $code ? '404.twig' : '500.twig';

    return new Response($app['twig']->render($page, array('code' => $code)), $code);
});